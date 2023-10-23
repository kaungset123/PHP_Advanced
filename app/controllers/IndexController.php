<?php

namespace App\controllers;

use App\classes\Auth;
use App\classes\CSRFToken;
use App\classes\Request;
use App\classes\Session;
use App\models\Order;
use App\models\OrderDetail;
use App\models\Payment;
use App\models\Product;
use Stripe\Payout;
use voku\helper\Paginator;

## in same folder
## no need to use (use keyword)
class IndexController extends BaseController{

    public function show(){
       $popular = Product::where("featured",2)->get();
       $count = Product::all()->count();
       list($products,$pages) = paginate(4,$count,new Product());
       $products = json_decode(json_encode($products));
       view('home',compact("products","pages","popular"));
    }

    public function productDetail($id){
        $product = Product::where("id",$id)->first();
        view("detail",compact("product"));
    }

    public function cart(){
        $post = Request::get('post');
        if(CSRFToken::checkToken($post->token)){
            $items =$post->cart;
            $carts=[];
            foreach($items as $item){
                $products = Product::where("id",$item)->first();
                $products->qty = 1;
                array_push($carts,$products);
            }
            echo json_encode($carts);
            exit;
        }else{
            echo "you are hacker";
        }      
    }

    public function payout(){
        $post = Request::get('post');
        if(CSRFToken::checkToken($post->token)) {
           Session::replace("cart-items",$post->items);
           echo "success";
           exit;
        }else{
            echo "You are hacker";
            exit;
        }       
    }

    public function saveItemToDatabase($status="Pending",$extraData=""){
        $items = Session::get('cart-items');
        $order_number = uniqid();
        $total=0;
        foreach($items as $item){
            $od = new OrderDetail();
            $total += $item->qty * $item->price;
            $od->user_id = Auth::user()->id;

        // order_detail table
            $od->product_id = $item->id;
            $od->unit_price = $item->price;
            $od->status = $status;
            $od->quantity = $item->qty;
            $od->total = $item->qty * $item->price;
            $od->order_no = $order_number;

            $od->save();
        }
        // Order table
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_no = $order_number;
        $order->order_extra = $extraData;
        $order->save();

        // payment table
        $payment = new Payment();
        $payment->user_id = Auth::user()->id;
        $payment->amount = $total;
        $payment->status = $status;
        $payment->save();
    }

    public function saveOrder($orders){
        $order = serialize($orders);
        return true;
    }

    public function showCart(){
        view('cart');
    }
}