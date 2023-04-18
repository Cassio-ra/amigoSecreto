<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <title>Amigo Secreto - @yield('title')</title>
    </head>
    <body class="bg-white dark:bg-slate-800 grid grid-cols-12">
        @include('app.explore')
        @yield('content')
    </body>
</html>