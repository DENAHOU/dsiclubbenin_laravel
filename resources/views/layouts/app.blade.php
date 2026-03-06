<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- CHANGER LE TITRE DANS LE FICHIER app.blade.php IL NE DOIT PLUS AFFICHER LARAVEL--}}
        <title>{{ config('app.name', 'Club DSI Bénin') }}</title>

        <!-- Font Awesome (place this in layouts/app.blade.php inside <head>) -->
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-SZg1Hv0kD9pS5EDQxmEywCyQwW4yZx1fG6EW2wE0p8tM8Yl6YIuQSeFVj1bl3N7VKgfHBlC9ZwTe9MkRUj5dtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

            <!-- Libraries Stylesheet -->
            <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
            <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">

            <!-- Customized Bootstrap Stylesheet -->
            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

            <!-- Template Stylesheet -->
            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
