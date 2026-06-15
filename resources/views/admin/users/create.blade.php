<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-zinc-900 leading-tight tracking-tight">
            {{ __('Tambah Pelanggan Baru') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-10">

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Informasi Akun Pelanggan</h3>
                    <p class="text-sm font-medium text-zinc-500 mt-1">Lengkapi data diri pelanggan untuk membuat akun baru.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pada isian:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-xl border-zinc-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 px-4 py-3 text-zinc-900 bg-zinc-50 focus:bg-white placeholder-zinc-400"
                               placeholder="Contoh: Budi Santoso" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full rounded-xl border-zinc-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 px-4 py-3 text-zinc-900 bg-zinc-50 focus:bg-white placeholder-zinc-400"
                               placeholder="Contoh: budi@example.com" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Password</label>
                            <input type="password" name="password"
                                   class="w-full rounded-xl border-zinc-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 px-4 py-3 text-zinc-900 bg-zinc-50 focus:bg-white placeholder-zinc-400"
                                   placeholder="Minimal 8 karakter" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full rounded-xl border-zinc-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 px-4 py-3 text-zinc-900 bg-zinc-50 focus:bg-white placeholder-zinc-400"
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-6 mt-6 border-t border-zinc-100 gap-4">
                        <a href="{{ route('admin.users.index') }}"
                           class="px-6 py-3 bg-zinc-100 text-zinc-600 font-bold rounded-xl hover:bg-zinc-200 transition-colors focus:ring-2 focus:ring-zinc-200 focus:outline-none">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-md transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none">
                            Simpan Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
