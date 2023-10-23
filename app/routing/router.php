<?php


use App\Routing\RouteDispatcher;

$router = new AltoRouter();

// map (method , route , target , route name)
$router->setBasePath("/E-Commerce/public");
$router->map("GET","/","App\controllers\IndexController@show","Home Route");
$router->map("POST","/cart","App\controllers\IndexController@cart","Cart Route");
$router->map("GET","/cart","App\controllers\IndexController@showCart","Cart Show Route");
$router->map("POST","/payout","App\controllers\IndexController@payOut","payOut Route");
$router->map("GET","/product/[i:id]/detail","App\controllers\IndexController@productDetail","Product Detail Route");

$router->map("POST","/payment/stripe","App\controllers\PaymentController@stripePayment","Payment Route");
$router->map("GET","/getitem","App\controllers\IndexController@getItemFromSession","Get Item From Session");


// for admin
require_once "admin_route.php";

// for user
require_once "user_route.php";

new RouteDispatcher($router); ## instantiating RouteDispatcher class