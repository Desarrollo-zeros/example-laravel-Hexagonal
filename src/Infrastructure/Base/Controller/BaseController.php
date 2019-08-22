<?php

namespace Src\Infrastructure\Base\Controller;

use Philo\Blade\Blade;

class BaseController
{
    protected $blade;
    private $data;

    public function __construct ($views,$cache) {
        $this->blade = new Blade($views, $cache);

    }

    protected function view($view, $data = [], $return = false){
        //$this->data = array_merge($this->data, $data);
        $blview = $this->blade->view()->make($view, $data)->render();

        if(! $return )
            return print( $blview );
        return $blview;

    }
}
