<?php

namespace App\controllers;
use App\controllers\BaseController;


class AdminController extends BaseController{
    public function index(){
        view("admin/home");
    }
}