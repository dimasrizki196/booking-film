<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight"
            style="font-family: 'Playfair Display', serif;">
            Atur Ulang Kata Sandi
        </h2>
        <p class="text-sm text-zinc-500 font-medium mt-2 leading-relaxed">
            Silakan buat kata sandi baru yang kuat dan aman untuk melanjutkan akses ke akun NextProjectFilm Anda.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-xs font-extrabold uppercase tracking-wider text-zinc-700 mb-2">
                Alamat Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
                autofocus autocomplete="username"
                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3.5 px-4 text-zinc-800 font-bold focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 shadow-sm"
                readonly>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-xs font-extrabold uppercase tracking-wider text-zinc-700 mb-2">
                Kata Sandi Baru
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                placeholder="Minimal 8 karakter..."
                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3.5 px-4 text-zinc-800 font-bold focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 shadow-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation"
                class="block text-xs font-extrabold uppercase tracking-wider text-zinc-700 mb-2">
                Konfirmasi Kata Sandi Baru
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="Ulangi kata sandi baru Anda..."
                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3.5 px-4 text-zinc-800 font-bold focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 shadow-sm">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-3">
            <button type="submit"
                class="w-full py-4 bg-zinc-900 text-[#FCBF49] font-black uppercase tracking-widest text-sm rounded-2xl hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 transition-all duration-300 shadow-xl hover:scale-[1.01]">
                Simpan Kata Sandi Baru
            </button>
        </div>
    </form>
</x-guest-layout>
