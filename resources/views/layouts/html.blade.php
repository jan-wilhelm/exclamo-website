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

        @yield('head')
    </head>

    <body class="bg-white">
        @yield('body')
        @stack('scripts')
    </body>
</html>