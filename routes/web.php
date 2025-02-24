<?php

use Bramus\Router\Router;

$router = new Router;

$router->get('/',App\Controllers\Client\HomeController::class.'@index');
$router->get('/home',App\Controllers\Client\HomeController::class.'@index');

$router->get('{id}/probytype',App\Controllers\Client\HomeController::class.'@probytype');
$router->get('{id}/prodetail',App\Controllers\Client\HomeController::class.'@prodetail');
$router->get('shop',App\Controllers\Client\HomeController::class.'@shop');
$router->post('seach',App\Controllers\Client\HomeController::class.'@search');

//cart
$router->get('/cart',App\Controllers\Client\CartController::class.'@listCart');
$router->post('/addcart',App\Controllers\Client\CartController::class.'@addCart');
$router->get('/cart/remove/{id}',App\Controllers\Client\CartController::class.'@removeCart');
$router->get('cart/update/{id}/{so_luong_dat}',App\Controllers\Client\CartController::class.'@updateCart');

//authenication
$router->get('/login', App\Controllers\Auth\AuthController::class . '@loginForm');
$router->get('/register', App\Controllers\Auth\AuthController::class . '@registerForm');
$router->post('/loginPost', App\Controllers\Auth\AuthController::class . '@login');
$router->post('/registerPost', App\Controllers\Auth\AuthController::class . '@register');

$router->mount('/admins', function () use ($router) {

    $router->get('/', App\Controllers\Admin\DashboardController::class . '@index');

    //danh muc
    $router->mount('/categories', function () use ($router) {

        $router->get('/', App\Controllers\Admin\CategoriesController::class . '@index');
        $router->get('/create', App\Controllers\Admin\CategoriesController::class . '@create');
        $router->post('/store', App\Controllers\Admin\CategoriesController::class . '@store');
        $router->get('/{id}/edit', App\Controllers\Admin\CategoriesController::class . '@edit');
        $router->post('/{id}/update', App\Controllers\Admin\CategoriesController::class . '@update');
        $router->get('/{id}/delete', App\Controllers\Admin\CategoriesController::class . '@delete');
    });

    //san pham
    $router->mount('/products', function () use ($router) {

        $router->get('/', App\Controllers\Admin\ProductController::class . '@index');
        $router->get('/create', App\Controllers\Admin\ProductController::class . '@create');
        $router->post('/store', App\Controllers\Admin\ProductController::class . '@store');
        $router->get('/{id}/edit', App\Controllers\Admin\ProductController::class . '@edit');
        $router->post('/{id}/update', App\Controllers\Admin\ProductController::class . '@update');
        $router->post('/delete', App\Controllers\Admin\ProductController::class . '@delete');
    });
});

$router->run();
