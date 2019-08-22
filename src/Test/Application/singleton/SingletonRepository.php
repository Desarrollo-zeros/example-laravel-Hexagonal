<?php

namespace Src\Test\Application\singleton;

use Src\Domain\Abstracts\IRepository;
use Src\Infrastructure\Base\Repository\GenericRepository;

class SingletonRepository
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance($entity)
    {
        if (!self::$instance instanceof IRepository)
        {
            self::$instance = new GenericRepository(SingletonDBContext::getInstance(), $entity);
        }
        return self::$instance;
    }
}
