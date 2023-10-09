<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="Shortcut icon" href="{{asset('/images/emoji.png')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}"> 
</head>

<body>
    @include('layout.nav')
    @yield('content');
    <script src="{{asset('/js/app.js')}}"></script>
</body>

</html>