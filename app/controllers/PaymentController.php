<?php

namespace App\controllers;

use App\classes\Request;
use Stripe\Charge;
use Stripe\Customer;

class PaymentController  {

    public function stripePayment(){
        $post = Request::get("post");
        $token = $post->stripeToken;
        $email = $post->stripeEmail;

       $customer = Customer::create([
            "email" => $email,
            "source" => $token
        ]);

        $charge = Charge::create([
            "customer" => $customer->id,
            "amount" => 5000,
            "currency" => 'usd'
        ]);
        $status = $charge->status;
        beautify($charge);

        $index = new IndexController();
        $index->saveItemToDatabase($status,json_encode($charge));
    }
}