<?php

use Bramus\Router\Router;

$router = new Router;

$router->get('/', function () {
    echo 'BASE_URL';
});

//authenication
$router->get('/login',App\Controllers\Auth\AuthController::class.'@loginForm');
$router->get('/register',App\Controllers\Auth\AuthController::class.'@registerForm');
$router->post('/loginPost',App\Controllers\Auth\AuthController::class.'@login');
$router->post('/registerPost',App\Controllers\Auth\AuthController::class.'@register');

$router->mount('/admins', function () use ($router) {

    $router->get('/', App\Controllers\Admin\DashboardController::class . '@index');


});

$router->run();
