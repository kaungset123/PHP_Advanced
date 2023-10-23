@extends("layout.master")

@section('title','Home page')

@section('content')
<style>
    .pagination>li {
        padding: 5px 15px;
        background: black;
        color: white;
        margin-right: 2px;
    }
</style>
    <div class="container my-4">
        <h1 class="text-center my-5">Popular Items</h1>
        <div class="row">
            @foreach($popular as $fav)
                <div class="col-md-3">
                    <div class="card mb-3" >
                        <div class="card-header text-center">{{$fav->name}}</div>
                        <div class="card-block"><img src="{{$fav->image}}" class="img-fluid"></div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-white btn-sm " href="<?php echo URL_ROOT . "product/$fav->id/detail"?>">
                                    <i class="fa fa-eye" aria-hidden="true" style="font-size:15px;"></i>
                                </a>
                                <span>{{$fav->price}}$</span>
                                <button class="btn btn-white btn-sm ">
                                    <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:20px;" onclick="addToCart('{{$fav->id}}')"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container my-4">
        <h1 class="text-center my-5">All Product</h1>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card mb-3" >
                        <div class="card-header text-center">{{$product->name}}</div>
                        <div class="card-block"><img src="{{$product->image}}" class="img-fluid"></div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-white btn-sm " href="<?php echo URL_ROOT . "product/$product->id/detail"?>">
                                    <i class="fa fa-eye" aria-hidden="true" style="font-size:15px;"></i>
                                </a>
                                <span>{{$product->price}}$</span>
                                <button class="btn btn-white btn-sm ">
                                    <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:20px;" onclick="addToCart('{{$product->id}}')"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4 offset-md-4">
        {!! $pages !!}
    </div>  
@endsection
