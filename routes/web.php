<?php

use Bramus\Router\Router;
$router=new Router;

$router->get('/', function () {
    echo 'BASE_URL';
});

$router->mount('/admin',function() use($router){

    $router->get('/',App\Controllers\Admin\DashboardController::class.'@index');
    

});




$router->run();