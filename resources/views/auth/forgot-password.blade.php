<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - {{ config('app.name', 'Next Project Film') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-zinc-900">

    <div class="min-h-screen flex flex-col justify-center items-center p-6">

        <div class="w-full max-w-md bg-white/5 backdrop-blur-xl border border-white/10 p-8 sm:p-10 rounded-3xl shadow-2xl">
            <div class="mb-6 text-sm text-zinc-400 text-center">
                {{ __('Lupa password Anda? Tidak masalah. Berikan alamat email Anda dan kami akan mengirimkan tautan reset password yang memungkinkan Anda membuat yang baru.') }}
            </div>

            <x-auth-session-status class="mb-4 text-white text-center" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-2xl border-white/10 bg-white/5 py-3 px-4 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <button type="submit"
                    class="w-full py-4 bg-[#FCBF49] text-zinc-900 font-extrabold rounded-2xl hover:bg-yellow-500 transition duration-200 shadow-lg mt-2">
                    {{ __('KIRIM TAUTAN RESET') }}
                </button>
            </form>

            <p class="text-center text-sm text-zinc-400 mt-6">
                <a href="{{ route('login') }}" class="font-bold text-white underline">Kembali ke Login</a>
            </p>
        </div>
    </div>
</body>

</html>
