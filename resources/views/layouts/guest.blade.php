<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Next Project Film') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Inter'] text-zinc-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center py-10 sm:py-0 bg-zinc-50 px-4 sm:px-6 lg:px-8">

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 sm:px-8 bg-white shadow-xl sm:rounded-3xl rounded-2xl">
                {{ $slot }}
            </div>

        </div>
    </body>

</html>
