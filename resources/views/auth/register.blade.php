<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - {{ config('app.name', 'Next Project Film') }}</title>
    <!-- Font Montserrat untuk Brand & Plus Jakarta Sans untuk UI -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-zinc-900">

    <div class="min-h-screen flex flex-col justify-center items-center p-6">

        <div
            class="w-full max-w-md bg-white/5 backdrop-blur-xl border border-white/10 p-8 sm:p-10 rounded-3xl shadow-2xl">

            <!-- Logo (Sesuai dengan Opsi 2: Montserrat) -->
            <div class="mb-8 text-center">
                <a href="/" class="text-3xl font-extrabold tracking-tighter text-[#FCBF49]"
                    style="font-family: 'Montserrat', sans-serif;">
                    NextProject<span class="text-white">Film</span>
                </a>
                <p class="text-sm text-zinc-400 mt-4">Bergabunglah dengan kami hari ini</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full rounded-2xl border-white/10 bg-white/5 py-3 px-4 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-2xl border-white/10 bg-white/5 py-3 px-4 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full rounded-2xl border-white/10 bg-white/5 py-3 px-4 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full rounded-2xl border-white/10 bg-white/5 py-3 px-4 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                </div>

                <button type="submit"
                    class="w-full py-4 bg-[#FCBF49] text-zinc-900 font-extrabold rounded-2xl hover:bg-yellow-500 transition duration-200 shadow-lg mt-6">
                    DAFTAR AKUN
                </button>
            </form>

            <p class="text-center text-sm text-zinc-400 mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-white underline">Masuk di
                    sini</a>
            </p>
        </div>
    </div>
</body>

</html>
