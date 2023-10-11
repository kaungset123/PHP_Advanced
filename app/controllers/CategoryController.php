<?php

namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Upload;
use App\controllers\BaseController;


class CategoryController extends BaseController{
    public function index()
    {
        view("admin/category/create");
    }

    public function store(){
        $post = Request::get("post");
        beautify(Request::all("file"));
        echo "<hr>";
        if(CSRFToken::checkToken($post->token)){
            // $upload = new Upload();
            // var_dump($upload->move(Request::get("file"))) ;
        }else{
           Session::flash("error","You don't have Authentication!");
           Redirect::back();
        }
    }
}