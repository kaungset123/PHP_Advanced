<?php

namespace App\classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest{
    private $error = [];
    private $error_message =[
        "unique"=>"the :attribute are already exist",
        "required"=>"the :attribute input must be fill",
        "minLength"=>"the :attribute input is at least :policy character",
        "maxLength"=>"the :attribute input is execced :policy character",
        "email"=>"invalid email name",
        "string"=>"the :attribute field must fill only string",
        "number"=>"the :attribute field must number",
        "mixed"=>"the :attribute field only allow a-zA-Z0-9@.$&"
    ];

    public function checkValidate($data,$policies){
        foreach($data as $column=>$value){
            if(in_array($column,array_keys($policies))){
                $this->doValidation([
                    'column'=>$column,
                    'value'=>$value,
                    'policies'=>$policies[$column]  // return array
                ]);
            }
        }
    }

    public function doValidation($data){
        $column = $data["column"];
        $value = $data["value"];
        foreach($data["policies"] as $rule => $policy){
          $valid =  call_user_func_array([self::class,$rule],[$column,$value,$policy]); // rule = method name  // call_user_func_array([class,method],param)
          if(!$valid){
                $this->setError(
                   str_replace(
                    [":attribute",":policy"],
                    [$column,$policy],
                    $this->error_message[$rule]
                   ),  // $rule is err argu of setError function
                   $column
                );
          }                                                           
        }
    }

    public function unique($column,$value,$table){ // checking user exits or not
        if($value != null && !empty(trim($value))){
           return !Capsule::table($table)->where($column,$value)->exists(); //if name exist=>return false // name notexist=>return true
        }
    }

    public function required($column,$value,$table){
      return  $value != null && !empty(trim($value)) ? true : false ; // checking input field is empty or not
    }

    public function minLength($column,$value,$option){ // checking user exits or not
        if($value != null && !empty(trim($value))){
           return strlen(trim($value)) >= $option; 
        }
    }

    public function maxLength($column,$value,$option){ 
        if($value != null && !empty(trim($value))){
           return strlen(trim($value)) <= $option; 
        }
    }

    public function email($column,$value,$option){ // checking user exits or not
        if($value != null && !empty(trim($value))){
           return filter_var($value,FILTER_VALIDATE_EMAIL);
        }
    }

    public function string($column,$value,$option){ // checking user exits or not
        if($value != null && !empty(trim($value))){
           return preg_match("/^[A-Za-z ]+$/",$value);
        }
    }

    public function number($column,$value,$option){ // checking user exits or not
        if($value != null && !empty(trim($value))){
           return preg_match("/^[0-9\.]+$/",$value);
        }
    }

    public function mixed($column,$value,$option){ // checking user exits or not
        if($value != null && !empty(trim($value))){
           return preg_match("/^[a-zA-Z0-9 \.\@$&]+$/",$value);
        }
    }

    public function setError($err,$key=null){
        if($key){
            $this->error[$key] = $err ;
        }else{
            $this->error[] = $err;
        }
    }

    public function hasError(){
        return count(($this->error)) > 0 ? true : false ;
    }

    public function getError(){
        return $this->error;
    }
}