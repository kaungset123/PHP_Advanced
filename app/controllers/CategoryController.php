<?php

namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\Upload;
use App\classes\ValidateRequest;
use App\controllers\BaseController;
use App\models\Category;

class CategoryController extends BaseController{

    public function index(){
        $cate = Category::all()->count();
        list($cats,$pages) = paginate(3,$cate,new Category());
        $cats = json_decode(json_encode($cats)); // changing array to object data type
        // beautify($cats);
        view("admin/category/create",compact('cats','pages'));  // cats return array value
    }

    public function store(){
        $post = Request::get("post");
        // beautify($post);
        // echo "<hr>";
        if(CSRFToken::checkToken($post->token)){
            // $upload = new Upload();
            // var_dump($upload->move(Request::get("file"))) ;
            $rule = [
                "name"=>["required"=>true,"minLength"=>"5","unique"=>"categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post,$rule);
            if($validator->hasError()){
                // beautify($validator->getError());
                $cats = Category::all();
                $errors = $validator->getError();
                // beautify($errors);
                view("admin/category/create",compact('cats','errors')); 
            }else{
               $slug = slug($post->name) ;
               $con = Category::create([
                "name" => $post->name,
                "slug" => $slug
               ]);

               if($con){
                $cats = Category::all();
                $success = "Category creation success";
                view("admin/category/create",compact('cats','success'));  // cats return array value 
               }else{
                echo "fail";
               }

            //    if($category->save()){ // saving to database table
            //         echo "category creation success";
            //    }else{
            //         echo "category creation fail";
            //    }

            }
        }else{
           Session::flash("error","You don't have Authentication!");
           Redirect::back();
        }
    }

    public function delete($id){
        $con = Category::destroy($id);
        if($con){
            Session::flash("delete_success","category deletion success");
            Redirect::to("/E-Commerce/public/admin/category/create");
        }else{
            Session::flash("delete_fail","category deletion fail");
            Redirect::to("/E-Commerce/public/admin/category/create");
        }
    }

    public function update(){
        $post = Request::get('post'); // getting all post data
        $data =[
            "name"=>$post->name,
            "token"=>$post->token,  
            "id"=>$post->id,
            "con"=>""
        ];
        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name"=>["required"=>true,"minLength"=>"5","unique"=>"categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post,$rules);
            

            $data['con']="we are good to go";
            echo json_encode($data);
        }else{
            $data['con']="token miss match exception";
            echo json_encode($data);
        }

    }
}
