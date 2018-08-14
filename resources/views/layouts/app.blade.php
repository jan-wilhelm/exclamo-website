@extends('layouts.html')

@section('head')
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/jquery.dropdown.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

    <link href="{{ asset('css/colors_2.css') }}" rel="stylesheet">
@endsection

@section('body')
    <div id="app" class="h-100 w-100">
        @include('layouts/navbar')
        <div class="mt-5 container">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('js/jquery.dropdown.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/de.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/en-gb.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
@endsection
