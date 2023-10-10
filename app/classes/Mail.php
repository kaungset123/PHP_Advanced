<?php

namespace App\classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail{
    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->setUp();
    }

    public function setUp(){
        if(getenv("APP_ENV") == "local"){
            $this->mail->SMTPDebug=2; //Enable verbose debug output
        }     
        $this->mail->isSMTP(); //Send using SMTP
        $this->mail->Host = getenv("SMTP_HOST"); //Set the SMTP server to send through
        $this->mail->SMTPAuth = true;    //Enable SMTP authentication
        $this->mail->Username = getenv("EMAIL_USERNAME");
        $this->mail->Password = getenv("EMAIL_PASSWORD");
        $this->mail->Port = getenv("SMTP_PORT");

        $this->mail->isHTML(true);
        // $this->mail->send();

        $this->mail->From = getenv("ADMIN_EMAIL");
        $this->mail->FromName = "kaungsetnaing";      
    }

    public function send($data){

        $this->mail->addAddress($data["to"]);
        $this->mail->Subject = $data["subject"];
        $this->mail->Body = make($data["filename"],$data);
        $this->mail->addEmbeddedImage('image9-41.png','lolipop');
        return $this->mail->send();
    }
}