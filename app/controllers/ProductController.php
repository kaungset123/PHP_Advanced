<?php

namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Request;
use App\controllers\BaseController;
use App\models\Category;
use App\models\SubCategory;
use App\classes\Session;
use App\classes\Redirect;
use App\classes\Upload;
use App\classes\ValidateRequest;
use App\models\Product;

class ProductController extends BaseController{

    public function home(){
        $products = Product::all();
        list($products,$pages) = paginate(4,count($products),new Product());
        $products = json_decode(json_encode($products));
        view("admin/product/home",compact("products","pages"));
    }

    public function create(){
        $cats = Category::all();
        $sub_cats = SubCategory::all();
        view("admin/product/create",compact("cats","sub_cats"));
    }

    public function store(){
        $posts=Request::get('post');
        $file=Request::get('file');

        if(CSRFToken::checkToken($posts->token)){
            $rules = [
                "name"=>["required"=>true,"unique"=>"products"],
                "price"=>["required"=>true],
                "description"=>["required"=>true]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($posts,$rules);
          
            if($validator->hasError()){
                // if any error is in input_field
                $errors = $validator->getError();
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                view("admin/product/create",compact("cats","sub_cats","errors"));
            }else{
                if(!empty($file->file->name)){
                    $upload = new Upload();
                    if($upload->move($file)){
                        $path = $upload->getPath(); // image's name in database
                        $product = new Product();
                        $product->name = $posts->name;
                        $product->price = $posts->price;
                        $product->cat_id = $posts->cat_id;
                        $product->sub_cat_id = $posts->sub_cat_id;
                        $product->description = $posts->description;
                        $product->image = $path;

                        if($product->save()){
                            $products = Product::all();
                            Session::flash("product_insert_success","product insertion successful");
                            Redirect::to("home",compact("products")); // if saving success, head to product's home page
                        }else{
                            $errors = ["New product insertion Fail!"];
                            $cats = Category::all();
                            $sub_cats = SubCategory::all();
                            view("admin/product/create",compact("cats","sub_cats","errors"));
                        }

                    }else{
                        $errors =["Please check image size and type"];
                        $cats = Category::all();
                        $sub_cats = SubCategory::all();
                        view("admin/product/create",compact("cats","sub_cats","errors"));
                    }
                }else{
                    $errors = ["Image field is empty"];
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    view("admin/product/create",compact("cats","sub_cats","errors"));
                }
                // if no error is in input_field
                // $success = "good to go";
                // $cats = Category::all();
                // $sub_cats = SubCategory::all();
                // view("admin/product/create",compact("cats","sub_cats","success"));
            }

        }else{
            Session::flash("error","You don't have Authentication!");
            Redirect::back();
        }
        // beautify($posts);
        // beautify($file);
    }

    public function edit($id){
        $cats = Category::all();
        $sub_cats = SubCategory::all();
        $products = Product::where("id",$id)->first();
        view("admin/product/edit",compact("products","cats","sub_cats"));
    }

    public function update($id){

        $posts=Request::get('post');
        $file=Request::get('file');
        $path="";

        if(CSRFToken::checkToken($posts->token)){
            $rules = [
                "name"=>["required"=>true],
                "price"=>["required"=>true],
                "description"=>["required"=>true]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($posts,$rules);
          
            if($validator->hasError()){
                // if any error is in input_field
                $errors = $validator->getError();
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                $products = Product::where("id",$id)->first();
                view("admin/product/edit",compact('errors','cats','sub_cats','products'));
            }else{
                if(empty($file->file->name)){
                    $path = $posts->old_image;  // when user not selecte a new image                
                }else{
                    $upload = new Upload();
                    if($upload->move($file)){
                    $path = $upload->getPath(); // image's name in database
                    }else{
                        $errors = ["Please check image size and type"];
                        $cats = Category::all();
                        $sub_cats = SubCategory::all();
                        $products = Product::where("id",$id)->first();
                        view("admin/product/edit",compact('errors','cats','sub_cats','products'));
                    }
                }
                $product = Product::where("id",$id)->first();
                $product->name = $posts->name;
                $product->price = $posts->price;
                $product->cat_id = $posts->cat_id;
                $product->sub_cat_id = $posts->sub_cat_id;
                $product->description = $posts->description;
                $product->image = $path;

                if($product->update()){
                    $products = Product::all();
                    Session::flash("product_insert_success","product edition successful");
                    // Redirect::to("home",compact("products")); // if saving success, head to product's home page
                    list($products,$pages) = paginate(4,count($products),new Product());
                    $products = json_decode(json_encode($products));
                    view("admin/product/home",compact("products","pages"));
                }else{
                    $errors = ["New product Edition Fail!"];
                    $products = Product::where('id',$id)->first();
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    view("admin/product/create",compact("cats","sub_cats","errors","products"));
                }

            }

        }else{
            Session::flash("product_edit_fail","product edition fail");
            Redirect::to("admin/product/".$id."/edit"); 
        }
    }
}