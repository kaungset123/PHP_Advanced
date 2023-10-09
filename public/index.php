<?php
// echo "hello world";

use App\classes\Mail;
use Illuminate\Database\Capsule\Manager as Capsule;
require_once "../bootstrap/init.php";

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
    "imgsrc"=> '<img src="cid:coding">',
    "img"=> 'URL_ROOT . "assets/images/coding.png"',
    "subject"=> "Test email from php advanced",
    "filename"=>"welcome",
    "img_link"=>"https://www.google.com/url?sa=i&url=https%3A%2F%2Funsplash.com%2Fs%2Fphotos%2Fbackground-image&psig=AOvVaw2t9nbGEJc7h5qzsllOtLfX&ust=1696912526004000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCMCk2feR6IEDFQAAAAAdAAAAABAJ"
];


// $mailer = new Mail();
// if($mailer->send($data))
//     echo "<h1>mail sending successful</h1>";
// else 
//     echo "<h1>mail sending fail</h1>";
// uoyp xkzg smqy hsnz