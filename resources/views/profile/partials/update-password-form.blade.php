<section class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-zinc-100">
    <header>
        <h2 class="text-lg font-medium text-zinc-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="font-medium text-zinc-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="font-medium text-zinc-700" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"
                class="font-medium text-zinc-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90" x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm font-bold text-green-600 flex items-center bg-green-50 px-3 py-1.5 rounded-lg border border-green-100">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
