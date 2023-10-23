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
use App\models\SubCategory;

class CategoryController extends BaseController{

    public function index(){
        // category lists
        $cate = Category::all()->count();
        list($cats,$pages) = paginate(3,$cate,new Category());
        // subcategory lists
        $subcate = SubCategory::all()->count();
        list($sub_cats,$sub_pages) = paginate(3,$subcate,new SubCategory());

        $cats = json_decode(json_encode($cats)); // changing array to object data type 
        $sub_cats = json_decode(json_encode($sub_cats));
        // beautify($cats);
        view("admin/category/create",compact('cats','pages','sub_cats','sub_pages'));  // cats return array value
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
                $errors = $validator->getError();
                // beautify($errors);

                $cate = Category::all()->count();
                list($cats,$pages) = paginate(3,$cate,new Category());
                $cats = json_decode(json_encode($cats)); // changing array to object data type
                // beautify($cats);
                view("admin/category/create",compact('cats','errors','pages'));  // cats return array value
            }else{
               $slug = slug($post->name) ;
               $con = Category::create([
                "name" => $post->name,
                "slug" => $slug
               ]);

               if($con){
                $success = "Category creation success";

                $sub_cats = SubCategory::all();
                $count =SubCategory::all()->count();
                $cate = Category::all()->count();
                list($sub_cats,$sub_pages) = paginate(3,$count, new SubCategory());
                list($cats,$pages) = paginate(3,$cate,new Category());
                $cats = json_decode(json_encode($cats)); // changing array to object data type
                $sub_cats = json_decode(json_encode($sub_cats));
                // beautify($cats);
                view("admin/category/create",compact('cats','success','pages','sub_cats','sub_pages'));  // cats return array value
               }else{
                $errors = "Category creation fail";
                $cate = Category::all()->count();
                list($cats,$pages) = paginate(3,$cate,new Category());
                $cats = json_decode(json_encode($cats)); // changing array to object data type
                // beautify($cats);
                view("admin/category/create",compact('cats','errors','pages'));  // cats return array value
               }

          

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
        // $data =[
        //     "name"=>$post->name,
        //     "token"=>$post->token,  
        //     "id"=>$post->id           
        // ];
        // echo json_encode($data);
        // beautify($post);
        
        echo "name =" . $post->name;
        echo "token=" . $post->token;

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name"=>["required"=>true,"minLength"=>"5","unique"=>"categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post,$rules);
            
            if($validator->hasError()){               
                $data['con']="validate error";
                echo json_encode($data);
            }else{    
                Category::where("id",$post->id)->update(["name"=>$post->name]);         
                $data['con']="we are good to go";
                echo json_encode($data);
            }

        }else{
            $data['con']="token miss match exception";
            echo json_encode($data);
        }

    }
}
