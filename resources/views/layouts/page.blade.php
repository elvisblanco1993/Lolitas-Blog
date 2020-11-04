<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lolitas Blog') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>

        {{-- Google AdSense --}}
        <script data-ad-client="ca-pub-6691661138979501" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body class="bg-gray-50 leading-normal tracking-normal font-Merriweather">


        @include('layouts.nav')

        {{-- Container --}}
        @yield('content')

        {{-- Footer --}}
        <footer class="text-gray-400 text-center text-xs mt-12 py-4">
            Copyright © {{ Carbon\Carbon::now()->format('Y') }} Lolita's Blog
        </footer>
        @livewireScripts
    </body>
</html>
