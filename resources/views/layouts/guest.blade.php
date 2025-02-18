<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <style>
            
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'City Civil Registry') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <header class="hero">
            <div class="hero-content">
                <img src="{{ asset('logo/ccro.png') }}" alt="Logo Left" class="logo-left">
                <img src="{{ asset('logo/Csjdm Logo.png') }}" alt="Logo Right" class="logo-right">
                <div class="hero-title">
                    <h2>City of San Jose Del Monte</h2>
                    <h3>Registrar’s Office (CCRO)</h3>
                </div>
            </div>
        </header>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
