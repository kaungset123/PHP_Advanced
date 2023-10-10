<?php

namespace App\classes;

class Request{
    public static function all($is_array=false){ // default object
        $result = [];
        if( count($_GET) > 0) $result['get']=$_GET;
        if( count($_POST) > 0) $result['post']=$_POST;
        $result['file']=$_FILES;

        return json_decode(json_encode($result),$is_array); // if $is_array is false => return object value
                                                          // if $is_array is true => return array value
    }  
    
    // function for getting input value
    public static function get($key){ 
        return self::all()->$key; // if all() with no param , it return object value , so we can get it with arrow operator(->)
    }

    // function for checking value exist or not
    public static function has($key){
        // return self::all()->$key ? true : false ;
        return array_key_exists($key,self::all(true)) ? true : false ; // if all(true) => return array // if all(false)=> return object
    }

    public static function old($key,$value){
        return isset(self::all()->$key->$value) ? self::all()->$key->$value : "";
    }

    // clearing data before next operation start
    public static function refresh(){
        $_POST = [];
        $_GET = [];
        $_FILES = [];
    }
}