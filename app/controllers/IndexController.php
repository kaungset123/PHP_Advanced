<?php

namespace App\controllers;

## in same folder
## no need to use (use keyword)
class IndexController extends BaseController{

    public function show(){
       view('welcome');

    }
}