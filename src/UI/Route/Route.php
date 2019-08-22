<?php

use Src\Infrastructure\Base\Router\Router;

$params = [
    'paths' => [
        'controllers' => '../Controllers/',
    ],
    'namespaces' => [
        'controllers' => 'Src\UI\Controllers',
    ],
    'base_folder' => __DIR__,
    'main_method' => 'main',
];

$router = new Router($params);


$router->get('/', function() {
    return 'Hello World!';
});
$router->get('/index', 'UserController@index');

$router->run();
