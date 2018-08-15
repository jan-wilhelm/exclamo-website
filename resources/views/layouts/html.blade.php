<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('img/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">



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
        @yield('head')
        <link href="//fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
        <style type="text/css">
            body, html {
                font-family: 'Raleway', sans-serif;
            }
        </style>
    </head>

    <body>
        @yield('body')
        @stack('scripts')
    </body>
</html>
