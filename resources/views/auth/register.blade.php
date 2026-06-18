<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - {{ config('app.name', 'Next Project Film') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-zinc-900">

    <div class="min-h-screen flex flex-col justify-center items-center p-6">

        <div
            class="w-full max-w-md bg-white/5 backdrop-blur-xl border border-white/10 p-8 sm:p-10 rounded-3xl shadow-2xl">

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
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="w-full rounded-2xl border-white/10 bg-white/5 py-3 pl-4 pr-12 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                        <button type="button" onclick="togglePassword('password', 'eye-1')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white transition">
                            <i id="eye-1" class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full rounded-2xl border-white/10 bg-white/5 py-3 pl-4 pr-12 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-2')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white transition">
                            <i id="eye-2" class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
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

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
