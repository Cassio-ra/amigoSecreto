<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles') {{-- links adicionadas na Tela --}}
        <title>Amigo Secreto - @yield('title')</title>
    </head>
    <body class="bg-white dark:bg-slate-800 grid grid-cols-12">
        @include('app.explore') {{-- Topbar --}}

        <div class="col-span-12 grid grid-cols-12 flex place-content-center mt-[1em]">
            @yield('content') {{-- Conteudo da Tela --}}
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
        @stack('scripts') {{-- Scripts adicionados na Tela --}}
    </body>
</html>