@extends('frontend.component.template')

@section('css')

@endsection

@section('main')
<main>
    <div id="react-card"></div>
    </div>
</main>
@endsection

@section('js')
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/Frontend.js')}}"></script>
@endsection
