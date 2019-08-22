<?php


namespace Src\Infrastructure\Base\Router;

class RouterCommand
{
    /**
     * @var RouterCommand|null Class instance variable
     */
    protected static $instance = null;

    protected $baseFolder;
    protected $paths;
    protected $namespaces;

    /**
     *
     */
    public function __construct($baseFolder, $paths, $namespaces)
    {
        $this->baseFolder = $baseFolder;
        $this->paths = $paths;
        $this->namespaces = $namespaces;
    }

    public function getMiddlewareInfo()
    {
        return [
            'path' => $this->baseFolder . '/' . $this->paths['middlewares'],
            'namespace' => $this->namespaces['middlewares'],
        ];
    }

    public function getControllerInfo()
    {
        return [
            'path' => $this->baseFolder . '/' . $this->paths['controllers'],
            'namespace' => $this->namespaces['controllers'],
        ];
    }

    /**
     * Get class instance
     *
     * @return RouterCommand
     */
    public static function getInstance($baseFolder, $paths, $namespaces)
    {
        if (null === self::$instance) {
            self::$instance = new static($baseFolder, $paths, $namespaces);
        }
        return self::$instance;
    }

    /**
     * Throw new Exception for Router Error
     *
     * @param $message
     *
     * @return RouterException
     * @throws
     */
    public function exception($message = '')
    {
        return new RouterException($message);
    }

    /**
     * Run Route Middlewares
     *
     * @param $command
     * @param $path
     * @param $namespace
     *
     * @return mixed|void
     * @throws
     */
    public function beforeAfter($command)
    {
        if (! is_null($command)) {
            $info = $this->getMiddlewareInfo();
            if (is_array($command)) {
                foreach ($command as $key => $value) {
                    $this->beforeAfter($value, $info['path'], $info['namespace']);
                }
            } elseif (is_string($command)) {
                $controller = $this->resolveClass($command, $info['path'], $info['namespace']);
                if (method_exists($controller, 'handle')) {
                    $response = call_user_func([$controller, 'handle']);
                    if ($response !== true) {
                        echo $response;
                        exit;
                    }

                    return $response;
                }

                return $this->exception('handle() method is not found in <b>'.$command.'</b> class.');
            }
        }

        return;
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @param $command
     * @param $params
     * @param $path
     * @param $namespace
     *
     * @return void
     * @throws
     */
    public function runRoute($command, $params = null)
    {
        $info = $this->getControllerInfo();
        if (! is_object($command)) {
            $segments = explode('@', $command);
            $controllerClass = str_replace([$info['namespace'], '\\', '.'], ['', '/', '/'], $segments[0]);
            $controllerMethod = $segments[1];

            $controller = $this->resolveClass($controllerClass, $info['path'], $info['namespace']);
            if (method_exists($controller, $controllerMethod)) {
                echo call_user_func_array(
                    [$controller, $controllerMethod],
                    (!is_null($params) ? $params : [])
                );
                return;
            }

            return $this->exception($controllerMethod . ' method is not found in '.$controllerClass.' class.');
        } else {
            if (! is_null($params)) {
                echo call_user_func_array($command, $params);
                return;
            }

            echo call_user_func($command);
        }
    }

    /**
     * Resolve Controller or Middleware class.
     *
     * @param $class
     * @param $path
     * @param $namespace
     *
     * @return object
     * @throws
     */
    protected function resolveClass($class, $path, $namespace)
    {
        $file = realpath(rtrim($path, '/') . '/' . $class . '.php');
        if (! file_exists($file)) {
            return $this->exception($class . ' class is not found. Please, check file.');
        }

        $class = $namespace . str_replace('/', '\\', $class);
        if (!class_exists($class)) {
            require_once($file);
        }

        return new $class();
    }
}
