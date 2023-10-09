<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorHandler{
    public function handleErrors($error_number,$error_message,$error_file,$error_line){
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}