<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="referrer" content="no-referrer">

    <link rel="icon" href="https://i.imgur.com/0zV9Src.png" type="image/x-icon" />
    <link rel="icon" href="https://i.imgur.com/0zV9Src.png" type="image/x-icon" />    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Website</title>
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    @yield('css')

</head>

<body>

    @yield('main')

    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
    @yield('js')
</body>

</html>