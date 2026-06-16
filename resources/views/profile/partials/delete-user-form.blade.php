<section class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-zinc-100 space-y-6">
    <header>
        <h2 class="text-lg font-medium text-zinc-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-zinc-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm text-zinc-500">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <input id="password" name="password" type="password"
                    class="mt-1 block w-full sm:w-3/4 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-red-500 focus:ring-red-500 transition duration-200"
                    placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-6 py-3 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 uppercase tracking-widest hover:bg-zinc-200 focus:bg-zinc-200 active:bg-zinc-300 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    {{ __('Cancel') }}
                </button>

                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
