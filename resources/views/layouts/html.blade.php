<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#009489">
        <meta name="apple-mobile-web-app-title" content="exclamo">
        <meta name="application-name" content="exclamo">
        <meta name="msapplication-TileColor" content="#009489">
        <meta name="theme-color" content="#009489">

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
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131051441-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-131051441-1');
        </script>

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
