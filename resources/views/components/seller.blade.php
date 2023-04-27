<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="font-sans antialiased">
    <div class="flex">
        <div class="min-h-screen bg-gray-100 grow">
            {{--            @include('layouts.navigation')--}}

            <x-seller-sidebar></x-seller-sidebar>

            <!-- Page Heading -->
            {{--            @if (isset($header))--}}
            {{--                <header class="bg-white shadow">--}}
            {{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
            {{--                        {{ $header }}--}}
            {{--                    </div>--}}
            {{--                </header>--}}
            {{--            @endif--}}
        </div>
        <!-- Page Content -->
        <main class="w-full">
            {{--Navbar--}}
            <x-navbar></x-navbar>

            {{--Messages--}}
            <x-messages></x-messages>

            <div class="p-6">
                {{ $slot }}
            </div>
        </main>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    </body>
</html>
