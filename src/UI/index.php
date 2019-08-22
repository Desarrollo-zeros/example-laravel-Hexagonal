<?php

namespace Src\UI;

use Src\UI\Router\Route;

include ("Router/Route.php");

$directorio_base = __DIR__."../" ;

$r = new Route();

var_dump($r->file_get_class_methods($directorio_base."/Router/Route.php"));
