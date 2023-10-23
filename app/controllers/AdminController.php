<?php

namespace App\controllers;

use App\classes\Auth;
use App\classes\Redirect;
use App\controllers\BaseController;


class AdminController extends BaseController{
    public function index(){
        if(Auth::check()){
            view("admin/home");
        }else{
            Redirect::to("http://localhost/E-Commerce/public/");
        }       
    }
}