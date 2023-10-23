@extends("layout.master")

@section("title","Product Home Page")

@section("content")
<style>
    .pagination>li {
        padding: 5px 15px;
        background: black;
        color: white;
        margin-right: 2px;
    }

    #edit_cat {
        cursor: pointer;
    }
</style>
        <div class="container">
            <div class="row">
                <div class="col-md-4 me-5" >
                    @include("layout.admin_sidebar")
                </div>
                <?php use App\classes\Session;;?>
                <div class="col-md-6 mt-4">
                    <?php if(Session::has("product_insert_success")):?>                   
                        <?php echo Session::flash("product_insert_success");?>
                    <?php endif ;?>

                        <!-- product table start -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                   
                                    @foreach($products as $product)
                                    <tr>
                                        <td scope="row">{{$product->id}}</td>
                                        <td><img src="{{$product->image}}" width="70" height="70"></td>
                                        <td>{{$product->name}}</td>
                                        <th >{{$product->price}}</th>
                                        <td>
                                            <a href="<?php echo URL_ROOT . "admin/product/$product->id/edit";?>"><i class="fa fa-pencil-square-o text-primary"></i></a>
                                            <a href="<?php echo URL_ROOT . "admin/product/$product->id/delete";?>"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach                  
                            </tbody>
                        </table>     
                        <div class="mt-4 offset-md-4">
                            {!! $pages !!}
                        </div>  
                        <!-- product table end -->
                </div>
            </div>
        </div>
@endsection