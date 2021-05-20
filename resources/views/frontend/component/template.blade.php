<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Website</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    @yield('css')

</head>

<body>
    @include('frontend.component.header')

    @yield('main')

    @include('frontend.component.footer')

    <script src="{{asset('js/app.js')}}"></script>
    @yield('js')
</body>

</html>
