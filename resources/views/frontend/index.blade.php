@extends('frontend.component.template')

@section('css')
<link rel="stylesheet" href="{{asset('css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('css/ReactMain.css')}}">
@endsection

@section('main')
<main>
    <div id="react-main"></div>
</main>
@endsection

@section('js')
<script src="{{asset('js/ReactMain.js')}}"></script>
@endsection
