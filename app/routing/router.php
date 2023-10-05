<?php

$router = new AltoRouter();

$router->setBasePath("/E-Commerce/public");
$router->map("GET","/","to the paradise","Home Route");
$match = $router->match();

if($match){
    echo "<pre>".print_r($match,true)."</pre>";
}else{
    echo "not Match";
}