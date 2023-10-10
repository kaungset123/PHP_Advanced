<?php


use App\Routing\RouteDispatcher;

$router = new AltoRouter();

// $router->setBasePath("/E-Commerce/public");
$router->map("GET","/","App\controllers\IndexController@show","Home Route");
// for admin
$router->map("GET","/admin","App\controllers\AdminController@index","Admin Home");
$router->map("GET","/admin/category/create","App\controllers\CategoryController@index","Category Create"); // for show
$router->map("POST","/admin/category/create","App\controllers\CategoryController@store","Category Store"); // for button click

new RouteDispatcher($router); ## instantiating RouteDispatcher class