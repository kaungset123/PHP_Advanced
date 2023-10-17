<?php


use App\Routing\RouteDispatcher;

$router = new AltoRouter();

// map (method , route , target , route name)
$router->setBasePath("/E-Commerce/public");
$router->map("GET","/","App\controllers\IndexController@show","Home Route");
// for admin
$router->map("GET","/admin","App\controllers\AdminController@index","Admin Home");
$router->map("GET","/admin/category/create","App\controllers\CategoryController@index","Category Create"); // for show
$router->map("POST","/admin/category/create","App\controllers\CategoryController@store","Category Store"); // for button click
$router->map("GET","/admin/category/[i:id]/delete","App\controllers\CategoryController@delete","Category Delete");
$router->map("POST","/admin/category/update","App\controllers\CategoryController@update","Category Update");
$router->map("POST","/admin/subcategory/create","App\controllers\SubCategoryController@store","Sub Category Create");
$router->map("POST","/admin/subcategory/update","App\controllers\SubCategoryController@update","Sub Category Update");
$router->map("GET","/admin/subcategory/[i:id]/delete","App\controllers\SubCategoryController@delete","Sub Category Delete");




new RouteDispatcher($router); ## instantiating RouteDispatcher class