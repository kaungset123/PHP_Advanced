<?php
// echo "hello world";

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use App\classes\Mail;
use App\classes\Session;
use App\classes\ValidateRequest;
use Illuminate\Database\Capsule\Manager as Capsule;
require_once "../bootstrap/init.php";

$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

// echo getenv("APP_NAME") . "<br>";  ## defined static member
// echo getenv("APP_DEVLOPER") . "<br>";
// echo getenv("APP_ENV");
// echo APP_ROOT;
// echo URL_ROOT;
// $user = Capsule::table("users")->where("id",2)->get();
// echo "<pre>".print_r($user,true)."</pre>";

$content = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
when an unknown printer took a galley of type and scrambled it to make a type 
specimen book. It has survived not only five centuries, but also the leap into 
electronic typesetting, remaining essentially unchanged. It was popularised in 
the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
and more recently with desktop publishing software like Aldus PageMaker including 
versions of Lorem Ipsum";
$data = [
    "to"=> "clanc6581@gmail.com",
    "to_name"=>"kaungsetnaing",
    "content"=> $content,
    "subject"=> "Test email from php advanced",
    "filename"=>"welcome",
    "img_link"=>"https://d150u0abw3r906.cloudfront.net/wp-content/uploads/2022/08/image9-41.png"
];


// $mailer = new Mail();
// if($mailer->send($data))
//     echo "<h1>mail sending successful</h1>";
// else 
//     echo "<h1>mail sending fail</h1>";
// uoyp xkzg smqy hsnz

// Session::remove("token");
// Session::add("name","testerrr");
// Session::get("name");
// Session::replace("name","testerrr03");
// Session::get("name");

// Session::flash("creat_success");


##### Validation Test ########  
// $data=[
//     "name"=>"Jack frankin",
//     "age"=>2,
//     "email"=>"Jack@gmail.com"
// ];

// $policy=[
//     "name"=>["string"=>true,"minLength"=>"5"],
//     "age"=>["number"=>true,"minLength"=>"2"],
//     "email"=>["email"=>true,"maxLength"=>"25"]
// ];

// $validator = new ValidateRequest();
// $con = $validator->checkValidate($data,$policy);

// if($validator->hasError()){
//     beautify($validator->getError());
// }else{
//     echo "Good to go";
// }