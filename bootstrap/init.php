<?php

use App\classes\Database;
use App\classes\ErrorHandler;

if(!isset($_SESSION))  session_start(); ## to ensure not ro start session many times
define("APP_ROOT",realpath(__DIR__."/../"));  ## APP_ROOT => C:\xampp\htdocs\E-Commerce
                                                ## realpath(__DIR__) =>  C:\xampp\htdocs\E-Commerce\app\config
define("URL_ROOT","http://localhost/E-Commerce/public/");
// require_once realpath(__DIR__ . '/vendor/autoload.php');                                          
require_once APP_ROOT . "/vendor/autoload.php";
require_once APP_ROOT . "/app/config/_env.php";
new Database();
require_once APP_ROOT . "/app/routing/router.php";
set_error_handler([new ErrorHandler(), 'handleErrors']);


