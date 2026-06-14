<x-guest-layout>
    <div class="mb-6 sm:mb-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-semibold text-zinc-900 tracking-tight font-sans">Wellcome</h2>
        <p class="text-xs sm:text-sm font-medium text-zinc-500 mt-2 font-sans">Silahkan Login terlebih dahulu untuk melanjutkan ke dashboard</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="font-medium text-zinc-700 font-sans" />
            <input id="email"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 shadow-sm focus:border-[#FCBF49] focus:ring-2 focus:ring-[#FCBF49]/50 transition duration-200 font-sans text-zinc-900 py-3"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="hello@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div x-data="{ show: false }" class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-zinc-700 font-sans" />
            <div class="relative mt-1">
                <input id="password" x-bind:type="show ? 'text' : 'password'"
                    class="block w-full rounded-2xl border-zinc-200 bg-zinc-50 shadow-sm focus:border-[#FCBF49] focus:ring-2 focus:ring-[#FCBF49]/50 transition duration-200 font-sans text-zinc-900 py-3 pr-12"
                    name="password" required autocomplete="current-password" placeholder="••••••••" />

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-zinc-400 hover:text-[#FCBF49] transition-colors">
                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-zinc-300 text-[#FCBF49] focus:ring-[#FCBF49] cursor-pointer transition">
                <span class="ms-2 text-sm text-zinc-600 font-medium font-sans">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-red-500 hover:text-red-600 transition-colors duration-200 font-sans"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <!-- Tombol dibulatkan (rounded-2xl) dan font extra tebal -->
            <button type="submit"
                class="w-full flex justify-center items-center px-4 py-3.5 bg-zinc-900 border border-transparent rounded-2xl font-extrabold text-sm text-white tracking-widest hover:bg-zinc-800 focus:bg-zinc-800 active:bg-black focus:outline-none focus:ring-2 focus:ring-[#C5D89D] focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                {{ __('LOG IN') }}
            </button>
        </div>

        <!-- Opsi Register -->
        <div class="text-center mt-4">
            <p class="text-sm font-medium text-zinc-600">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200 underline">
                    {{ __('Daftar di sini') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
