<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Next Project Film') }}</title>
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
                <p class="text-sm text-zinc-400 mt-4">Silakan login terlebih dahulu</p>
            </div>

            <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-2xl border-white/10 bg-white/5 py-3 px-4 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-300 mb-1.5">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="w-full rounded-2xl border-white/10 bg-white/5 py-3 pl-4 pr-12 text-white placeholder-zinc-500 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200">

                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white transition duration-200">
                            <i id="eye-icon" class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-zinc-400 font-medium cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="rounded border-zinc-600 bg-zinc-800 text-[#FCBF49] focus:ring-[#FCBF49]">
                        <span class="ml-2">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-bold text-[#FCBF49] hover:underline">Lupa
                            password?</a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-4 bg-[#FCBF49] text-zinc-900 font-extrabold rounded-2xl hover:bg-yellow-500 transition duration-200 shadow-lg">
                    LOG IN
                </button>
            </form>

            <p class="text-center text-sm text-zinc-400 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-white underline">Daftar di
                    sini</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
