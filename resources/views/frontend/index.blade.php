@extends('frontend.component.template')

@section('css')

@endsection

@section('main')
<main>
    <div id="react-card"></div>
    <div class="svg-container">

        {{-- <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 0 1920 1080" xml:space="preserve">
            <g>
                <rect stroke="#000" transform="rotate(-45 1509,302)" id="svg_5" rx="15" height="500" width="300" y="25"
                    x="1355" stroke-width="1.5" fill="#fff" />
                <rect stroke="#000" transform="rotate(-45 1209,302)" id="svg_4" rx="15" height="500" width="300" y="25"
                    x="1055" stroke-width="1.5" fill="#fff" />
                <rect stroke="#000" transform="rotate(-45 909,302)" id="svg_3" rx="15" height="500" width="300" y="25"
                    x="755" stroke-width="1.5" fill="#fff" />
                <rect stroke="#000" transform="rotate(-45 609,302)" id="svg_2" rx="15" height="500" width="300" y="25"
                    x="455" stroke-width="1.5" fill="#fff" />
                <rect stroke="#000" id="svg_1" rx="15" height="500" width="300" stroke-width="1.5"
                    fill="#fff" />
            </g>
        </svg> --}}


    </div>
</main>
@endsection

@section('js')
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/Frontend.js')}}"></script>
@endsection
