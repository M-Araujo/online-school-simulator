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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <main class="pt-8 px-4 sm:px-6 lg:px-8">
            @isset($header)
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                        {{ $header }}
                    </h1>
                </div>
            @endisset
        
            {{ $slot }}
        </main>
        
    </div>

    @if(session('success'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 3000)" 
            x-show="show" 
            class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg transition"
        >
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show" 
            class="fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded shadow-lg transition"
        >
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
        @endif

</body>

</html>