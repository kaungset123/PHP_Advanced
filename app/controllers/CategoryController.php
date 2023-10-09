<?php

namespace App\controllers;
use App\controllers\BaseController;


class CategoryController extends BaseController{
    public function index()
    {
        view("admin/category/create");
    }

    public function store(){
        beautify($_POST);
        echo "I will show for category";
    }
}