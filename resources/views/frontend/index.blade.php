@extends('frontend.component.template')

@section('css')
<link rel="stylesheet" href="{{asset('css/ReactContainer.css')}}">
@endsection

@section('main')
<main>
    <div id="react-main"></div>
</main>
@endsection

@section('js')
<script src="{{asset('js/ReactContainer.js')}}"></script>
@endsection
