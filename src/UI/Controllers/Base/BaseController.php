<?php

namespace Src\UI\Controllers\Base;

use Philo\Blade\Blade;

class BaseController
{
    protected $blade;

    public function __construct () {
        $views = __DIR__ . '/views';
        $cache = __DIR__ . '/cache';
        $this->blade = new Blade($views, $cache);
    }

    protected function view($view, $data = [], $return = false){
        $this->data = array_merge($this->data, $data);
        $blview = $this->blade->view()->make($view, $this->data)->render();
        if(! $return )
            return print( $blview );
        return $blview;
    }
}
