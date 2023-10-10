<?php

namespace App\classes;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorHandler{
    public function handleErrors($error_number,$error_message,$error_file,$error_line){
        echo "There is an error inside".$error_file."at line ".  "$error_line";
        echo  "<br>rorblem occour because of {$error_message} and error number is {$error_number}";
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}