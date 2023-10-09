<?php
namespace App\Routing;

use AltoRouter;

class RouteDispatcher{
    private $match,$controller,$method;

    public function __construct(AltoRouter $router)
    {
        $this->match = $router->match(); ## return true or false
        if($this->match){
            list($controller,$method) = explode("@",$this->match["target"]); ## spliting controller and method by @

            $this->controller = $controller;
            $this->method = $method;

            if(is_callable([new $this->controller,$this->method])){
                // echo "It is callable";
                call_user_func_array([new $this->controller,$this->method],$this->match["params"]);
            }else{
                echo "It is uncallable";
            }
        }else{
            header($_SERVER["SERVER_PROTOCOL"] . "404 not found");
            echo "not match route";
        }
    }

}