<?php

namespace Src\UI\singleton;

use Src\Domain\Abstracts\IUnitOfWork;
use Src\Infrastructure\Base\UnitOfWork\UnitOfWork;

class SingletonUnitWork
{
    private static $instance;

    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!self::$instance instanceof IUnitOfWork)
        {
            self::$instance = new UnitOfWork(SingletonDBContext::getInstance());
        }
        return self::$instance;
    }

}
