<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
        window.Exclamo = {
            @if(Auth::check())
                userId: {{ auth()->user()->id }},
            @endif
            url: '{{ url("/") }}'
        };
    </script>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/fonts.min.css') }}" />

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/jquery.dropdown.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

    <link href="{{ asset('css/colors_2.css') }}" rel="stylesheet">
</head>

<body class="bg-white">

    @include('layouts/navbar')
    <div id="app" class="mt-5 container">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('js/jquery.dropdown.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/de.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/en-gb.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

    @stack('scripts')
</body>
</html>
