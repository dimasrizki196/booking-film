<x-guest-layout>
    <div class="mb-6 sm:mb-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-semibold text-zinc-900 tracking-tight font-sans">Daftar Akun</h2>
        <p class="text-xs sm:text-sm font-medium text-zinc-500 mt-2 font-sans">Bergabunglah dengan Next Project Film</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="font-medium text-zinc-700 font-sans" />
            <input id="name"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 shadow-sm focus:border-[#FCBF49] focus:ring-2 focus:ring-[#FCBF49]/50 transition duration-200 font-sans text-zinc-900 py-3"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="font-medium text-zinc-700 font-sans" />
            <input id="email"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 shadow-sm focus:border-[#FCBF49] focus:ring-2 focus:ring-[#FCBF49]/50 transition duration-200 font-sans text-zinc-900 py-3"
                type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="hello@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-zinc-700 font-sans" />
            <div class="relative mt-1">
                <input id="password" x-bind:type="show ? 'text' : 'password'"
                    class="block w-full rounded-2xl border-zinc-200 bg-zinc-50 shadow-sm focus:border-[#FCBF49] focus:ring-2 focus:ring-[#FCBF49]/50 transition duration-200 font-sans text-zinc-900 py-3 pr-12"
                    name="password" required autocomplete="new-password" placeholder="••••••••" />

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

        <div x-data="{ show: false }">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-medium text-zinc-700 font-sans" />
            <div class="relative mt-1">
                <input id="password_confirmation" x-bind:type="show ? 'text' : 'password'"
                    class="block w-full rounded-2xl border-zinc-200 bg-zinc-50 shadow-sm focus:border-[#FCBF49] focus:ring-2 focus:ring-[#FCBF49]/50 transition duration-200 font-sans text-zinc-900 py-3 pr-12"
                    name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />

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
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full flex justify-center items-center px-4 py-3.5 bg-zinc-900 border border-transparent rounded-2xl font-extrabold text-sm text-white tracking-widest hover:bg-zinc-800 focus:bg-zinc-800 active:bg-black focus:outline-none focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg font-sans">
                {{ __('REGISTER') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm font-medium text-zinc-600 font-sans">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200 underline font-sans">
                    {{ __('Masuk di sini') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
