@extends('layouts.html')

@section('head')
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vue-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />
@endsection

@section('body')
    <div class="w-100 d-flex flex-column" id="app">
        <div class="w-100 mb-5" id="app-content" v-cloak>
            @include('layouts.navbar')
            <div class="mt-5 container">
                @yield('content')
            </div>
        </div>
        @include('layouts.footer')
    </div>
    <script src="{{ asset('js/lang-' . app()->getLocale() . '.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/de.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/en-gb.js"></script>
@endsection
