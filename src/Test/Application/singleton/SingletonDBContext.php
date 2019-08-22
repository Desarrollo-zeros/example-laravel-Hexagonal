<?php

namespace Src\Test\Application\singleton;

use Src\Infrastructure\Abstracts\IDBBaseContext;
use Src\Infrastructure\Base\DbContextBase;
use Src\Infrastructure\DBContext;

class SingletonDBContext
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof IDBBaseContext)
        {
            self::$instance = new DBContext();
        }

        return self::$instance;
    }
}
