@extends("layout.master")

@section('title','Product Detail page')

@section('content')
    <div class="container mt-5">      
            <div class="row" style="border: 1px solid white; padding:2rem 1rem;" >
                <div class="col-md-2 ">
                    <img style="width:150px;height:180px;" src="<?php echo $product->image ;?>">
                </div>
                <div class="col-md-10">
                    <h3>{{$product->name}}</h3>
                    <p>{{$product->description}}</p>
                    <button class="btn btn-sm btn-primary" id="detail_price" >{{$product->price}} $</button>
                    <button class="btn btn-sm btn-primary">
                        Add to Cart  
                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:18px;"></i>
                    </button>
                    <p class="mt-2">
                        <span>
                            Rate:
                            <i class="fa fa-star text-white" aria-hidden="true"></i>
                            <i class="fa fa-star text-white" aria-hidden="true"></i>
                            <i class="fa fa-star text-white" aria-hidden="true"></i>
                            <i class="fa fa-star text-white" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o text-white" aria-hidden="true"></i>

                        </span>
                    </p>
                </div>
            </div>
    </div>
@endsection
