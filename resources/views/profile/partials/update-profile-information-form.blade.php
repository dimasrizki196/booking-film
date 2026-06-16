<section class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-zinc-100">
    <header>
        <h2 class="text-lg font-medium text-zinc-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" :value="__('Name')" class="font-medium text-zinc-700" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-medium text-zinc-700" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-100">
                    <p class="text-sm font-medium text-red-800 flex flex-col sm:flex-row sm:items-center">
                        <span>{{ __('Your email address is unverified.') }}</span>

                        <button form="send-verification"
                            class="mt-2 sm:mt-0 sm:ml-2 underline font-bold text-red-600 hover:text-red-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCBF49] transition duration-200">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p
                            class="mt-3 font-bold text-sm text-green-600 bg-green-50 p-2 rounded-lg border border-green-100 inline-block">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
