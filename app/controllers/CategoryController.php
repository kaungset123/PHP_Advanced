<?php

namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\controllers\BaseController;


class CategoryController extends BaseController{
    public function index()
    {
        view("admin/category/create");
    }

    public function store(){
        $post = Request::get("post");
        if(CSRFToken::checkToken($post->token)){
            echo "go";
        }else{
           Session::flash("error","You don't have Authentication!");
           Redirect::back();
        }
    }
}