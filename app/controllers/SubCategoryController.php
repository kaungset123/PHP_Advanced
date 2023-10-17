<?php

namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Request;
use App\classes\ValidateRequest;
use App\controllers\BaseController;
use App\models\SubCategory;
use App\classes\Session;
use App\classes\Redirect;

class SubCategoryController extends BaseController {

    public function store(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name"=>["unique"=>"sub_categories","minLength"=>"5"]
            ];
            $validator =new ValidateRequest();
            $validator->checkValidate($post,$rules);
            if($validator->getError()){
                header('HTTP/1.1 422 Validation Error!',true,422);
                $errors = $validator->getError();
                echo json_encode($errors);
                exit;
            }else{
                $subCat = new SubCategory();
                $subCat->name = $post->name;
                $subCat->cat_id = $post->pcat_id;
                if($subCat->save()){
                    echo "success";
                    exit;
                }else{
                    header('HTTP/1.1 422 Validation Error!',true,422);
                    echo "Sub Category create fail";
                    exit;
                }
            }
           
        }else{
            header('HTTP/1.1 422 Token Missmatch Error!',true,422);
            echo "Token Missmatch Error";
            exit;
        }
       
    }

    public function update(){
        $post = Request::get('post');
        // echo json_encode($post);
        // exit;

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name"=>["unique"=>"sub_categories","minLength"=>"5"]
            ];
            $validator =new ValidateRequest();
            $validator->checkValidate($post,$rules);
            if($validator->getError()){
                header('HTTP/1.1 422 Validation Error!',true,422);
                $errors = $validator->getError();
                echo json_encode($errors);
                exit;
            }else{
                SubCategory::where("id",$post->id)->update(["name"=>$post->name]);
                echo "sub category edition success";
                exit;
            }          
        }else{
            header('HTTP/1.1 422 Token Missmatch Error!',true,422);
            echo "Token Missmatch Error";
            exit;
        }
    }

    public function delete($id){

        $con = SubCategory::destroy($id);
        if($con){
            Session::flash("delete_success","subcategory deletion success");
            Redirect::to("/E-Commerce/public/admin/category/create");
        }else{
            Session::flash("delete_fail","subcategory deletion fail");
            Redirect::to("/E-Commerce/public/admin/category/create");
        }
    }
}