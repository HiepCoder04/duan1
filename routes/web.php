<?php
use Bramus\Router\Router;

$router=new Router;


$router->mount('/admins',function() use($router){

    $router->get('/',App\Controllers\Admin\DashboardController::class.'@index');
    

    
    //danh muc
    $router->mount('/categories',function() use($router){

    $router->get('/',App\Controllers\Admin\CategoriesController::class.'@index');
    $router->get('/create',App\Controllers\Admin\CategoriesController::class.'@create');
    $router->post('/store',App\Controllers\Admin\CategoriesController::class.'@store');
    $router->get('/{id}/edit',App\Controllers\Admin\CategoriesController::class.'@edit');
    $router->post('/{id}/update',App\Controllers\Admin\CategoriesController::class.'@update');
    $router->get('/{id}/delete',App\Controllers\Admin\CategoriesController::class.'@delete');
    });

     //san pham
     $router->mount('/products',function() use($router){

        $router->get('/',App\Controllers\Admin\ProductController::class.'@index');
        $router->get('/create',App\Controllers\Admin\ProductController::class.'@create');
        $router->post('/store',App\Controllers\Admin\ProductController::class.'@store');
        $router->get('/{id}/edit',App\Controllers\Admin\ProductController::class.'@edit');
        $router->post('/{id}/update',App\Controllers\Admin\ProductController::class.'@update');
        $router->post('/delete',App\Controllers\Admin\ProductController::class.'@delete');
        });
});
