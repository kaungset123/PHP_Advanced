<?php

namespace App\controllers;

use App\classes\Auth;
use App\models\User;
use App\classes\Redirect;
use App\classes\CSRFToken;
use App\classes\Request;
use App\classes\Session;
use App\classes\ValidateRequest;
use App\controllers\BaseController;

class UserController extends BaseController {

    public function showLogin(){
        if(Auth::check()){
            Redirect::to("/E-Commerce/public/cart");
        }else{
            view("user/login");
        }
    }

    public function login(){
        $posts = Request::get('post');
        // beautify($posts);
        if(CSRFToken::checkToken($posts->token)){
            $user = User::where("email",$posts->email)->first();
            if($user){
                if(password_verify($posts->password,$user->password)){
                    Session::add("user_id",$user->id);
                    Redirect::to("/E-Commerce/public/cart");
                }else{
                    $errors = ["wrong password!"];
                    view("user/login",compact("errors"));
                }              
            }else{
                $errors = ["no user with that email"];
                view("user/login",compact("errors"));
            }
        }else{
            Session::flash("token_error","Token is Missing");
            Redirect::to("/E-Commerce/public/user/login");
        }
       
    }

    public function showRegister(){
        view("user/register");
    }

    public function register(){
        $posts = Request::get('post');
        // beautify($posts);
        if(CSRFToken::checkToken($posts->token)){
            if($posts->password === $posts->confirmpassword){
                $rules =[
                    "name"=>["minLength"=>3],
                    "email"=>["unique"=>"users"],
                    "password"=>["minLength"=>5]
                ];
                $validator = new ValidateRequest();
                $validator->checkValidate($posts,$rules);
                if($validator->hasError()){
                    $errors = $validator->getError();
                    view("user/register",compact("errors"));
                }else{
                    $user = new User();
                    $user->name = $posts->name;
                    $user->email = $posts->email;
                    $user->password = password_hash($posts->password,PASSWORD_BCRYPT);

                    if($user->save()){
                        Session::flash("success_message","Regestration success");
                        Redirect::to("login");
                    }else{
                        Session::flash("error_message","Regestration fail");
                        Redirect::to("user/register");
                    }
                }
            }else{
                $errors=["Password don't match"];
                view("user/register",compact("errors"));
            }
           
        }else{
            Session::flash("token_error","Token is Missing");
            Redirect::to("/E-Commerce/public/admin/user/register");
        }
    }

    public function logout(){
        Session::remove("user_id");
        Redirect::to("http://localhost/E-Commerce/public/");
    }
}