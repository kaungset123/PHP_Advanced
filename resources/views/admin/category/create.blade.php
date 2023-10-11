@extends ('layout.master')

@section('title','Category Create')

@section('content')

<div class="container">
        <!-- <img src="{{asset('/images/coding.png')}}"> -->
        <div class="col-md-8 offset-md-2">
        <h1 class=" text-center my-3 " id="cat">Create Category</h1>
        <?php
            use App\classes\Session;
            // Session::flash("error") ;?>
            
            <form action="<?php 
            use App\classes\CSRFToken;
            echo URL_ROOT . "admin/category/create";?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Category</label>
                    <input type="text" class="form-control" id="name cat_input"  placeholder="category name.." name="name" style="box-shadow:-1px 4px 10px mediumpurple; padding:8px; border:none;">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label text-white">Image</label>
                    <input type="file" class="form-control" id="file"   name="file" style="box-shadow:-1px 4px 10px mediumpurple; padding:8px; border:none;">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <input type="hidden" name="token" value="<?php CSRFToken::_token()?>">
                <div class="float-end">
                    <button type="submit" class="btn btn-sm text-white pb-2" id="create_button" style="box-shadow: 1px 2px 7px black; border:none;padding-top:7px;">Create</button>
                </div>
            </form>
        </div>
    </div>

@endsection

  
