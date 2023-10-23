<?php

$router->map("GET","/admin","App\controllers\AdminController@index","Admin Home");

$router->map("GET","/admin/category/create","App\controllers\CategoryController@index","Category Create"); // for show
$router->map("POST","/admin/category/create","App\controllers\CategoryController@store","Category Store"); // for button click

$router->map("GET","/admin/category/[i:id]/delete","App\controllers\CategoryController@delete","Category Delete");
$router->map("POST","/admin/category/update","App\controllers\CategoryController@update","Category Update");

$router->map("POST","/admin/subcategory/create","App\controllers\SubCategoryController@store","Sub Category Create");
$router->map("POST","/admin/subcategory/update","App\controllers\SubCategoryController@update","Sub Category Update");
$router->map("GET","/admin/subcategory/[i:id]/delete","App\controllers\SubCategoryController@delete","Sub Category Delete");

$router->map("GET","/admin/product/home","App\controllers\ProductController@home","Product Home");

$router->map("GET","/admin/product/create","App\controllers\ProductController@create","Product Create");
$router->map("POST","/admin/product/create","App\controllers\ProductController@store","Product Store");

$router->map("GET","/admin/product/[i:id]/edit","App\controllers\ProductController@edit","Product Edit");
$router->map("POST","/admin/product/[i:id]/edit","App\controllers\ProductController@update","Product Update");
$router->map("GET","/admin/product/[i:id]/delete","App\controllers\ProductController@delete","Product Delete");