@extends ('layout.master')

@section('title','Category Create')

@section('content')

<div class="container">
        <!-- <img src="{{asset('/images/coding.png')}}"> -->
        <div class="col-md-8 offset-md-2">
        <h1 class=" text-center my-3 " id="cat">Create Category</h1>
            <form action="<?php echo URL_ROOT . "admin/category";?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Category</label>
                    <input type="text" class="form-control" id="name"  placeholder="category name.." name="name">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</d    iv> -->
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-sm text-white pb-2" id="button">Create</button>
                </div>
            </form>
        </div>
    </div>

@endsection

  
