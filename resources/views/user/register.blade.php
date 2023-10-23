@extends("layout.master")

@section("title","User Register")

@section("content")
        <h1 class="text-center my-4">Register Here!</h1>
        <div class="container">
            <div class="col-md-6 offset-md-3">
                @include('layout.report_message')
                <form action="<?php echo  URL_ROOT . "user/register";?>" method="post">
                    <input type="hidden" id="token" name="token" value="<?php
                    use App\classes\CSRFToken;
                    echo CSRFToken::_token();?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="login">Already a member!? please login</a>
                        <span >
                            <button class="btn btn-warning btn-sm">Cancle</button>
                            <button class="btn btn-primary btn-sm">Register</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
@endsection