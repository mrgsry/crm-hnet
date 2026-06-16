<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/img/hnetlogo.png') }}">
</head>

<body class="font-sans text-gray-900 antialiased relative">
    <div class="fixed inset-0 bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 relative z-10">
        <div class="mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
            <div class="text-center mb-6">
                <a href="/" class="inline-flex items-center justify-center mb-4">
                    <img src="{{ asset('storage/img/hnetlogo.png') }}" alt="HNet Logo" class="w-40 h-40 object-contain">
                </a>
            </div>
            <div class="w-full sm:max-w-md bg-gray-800 p-8 rounded-lg shadow-md border border-gray-700 text-white">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>