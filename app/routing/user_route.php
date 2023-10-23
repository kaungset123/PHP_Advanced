<?php

$router->map("GET","/user/login","App\controllers\UserController@showLogin","User Login Show");
$router->map("POST","/user/login","App\controllers\UserController@login","User Login");
$router->map("GET","/user/register","App\controllers\UserController@showRegister","User Register Show");
$router->map("POST","/user/register","App\controllers\UserController@register","User Register");
$router->map("GET","/user/logout","App\controllers\UserController@logout","User Logout");