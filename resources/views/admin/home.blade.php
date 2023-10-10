@extends('layout.master')

@section('title',"Admin Home")

@section ('content')
    <h1>Welcome back Admin</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layout.admin_sidebar')
            </div>

            <div class="col-md-9">

            </div>
        </div>
    </div>
@endsection