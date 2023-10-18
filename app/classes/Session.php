<?php

namespace App\classes;

class Session{
    public static function add($key,$value){
        if(!self::has($key)){
            $_SESSION[$key] = $value;
        }else{
            echo "session with that name " .$key." is already exist";
        }
    }

    public static function has($key){
        return isset($_SESSION[$key]) ? true : false ;
    }

    public static function remove($key){
        if(self::has($key)){
            unset($_SESSION[$key]);

        }
    }

    public static function get($key){
        if(self::has($key)){
            return $_SESSION[$key];
        }else{
            return NULL;
        }
    }

    public static function replace($key,$value){
        if(self::has($key)){
            self::remove($key);
        }
        self::add($key,$value);
    } 

    public static function flash($key,$value=""){
        if(!empty($value)){
            self::replace($key,$value);
        }else{
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>'.self::get($key).'</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        self::remove($key);
        }
    }
}