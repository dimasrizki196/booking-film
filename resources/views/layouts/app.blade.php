<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Next Project Film') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-zinc-900 bg-zinc-50">

    <!-- Wrapper Utama -->
    <div class="min-h-screen bg-zinc-50">

        <!-- Panggil Sidebar -->
        @include('layouts.navigation')

        <!-- Area Konten (Digeser ke Kanan di Laptop) -->
        <div class="flex flex-col md:ml-64 min-h-screen transition-all duration-300 pt-[72px] md:pt-0">

            <!-- Header Halaman Putih (Glassmorphism Bening) -->
            @if (isset($header))
                <header class="sticky top-0 z-30 bg-white/60 backdrop-blur-lg shadow-sm border-b border-white/40">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>

</html>
