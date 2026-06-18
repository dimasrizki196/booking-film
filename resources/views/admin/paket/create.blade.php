<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Tambah Paket Layanan') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-10">

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Informasi Paket Baru</h3>
                    <p class="text-sm font-medium text-zinc-500 mt-1">Lengkapi detail di bawah ini untuk menambahkan
                        paket layanan baru.</p>
                </div>

                <form action="{{ route('admin.paket.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Nama Paket</label>
                        <input type="text" name="nama_paket" value="{{ old('nama_paket') }}"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                            placeholder="Contoh: Paket Cinematic Premium" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                            placeholder="Jelaskan detail apa saja yang didapatkan oleh pelanggan..." required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Harga (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-zinc-400 font-bold">Rp</span>
                                </div>
                                <input type="text" id="harga_display" inputmode="numeric"
                                    class="w-full pl-12 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-bold text-lg"
                                    placeholder="0" required>
                                <input type="hidden" name="harga" id="harga_actual" value="{{ old('harga') }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Durasi Pengerjaan</label>
                            <div class="relative">
                                <input type="number" name="durasi_pengerjaan" value="{{ old('durasi_pengerjaan') }}"
                                    class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-bold pr-16"
                                    placeholder="0" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-zinc-400 font-bold">Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-6 mt-6 border-t border-zinc-100 gap-4">
                        <a href="{{ route('admin.paket.index') }}"
                            class="px-6 py-3 bg-zinc-100 text-zinc-800 font-bold rounded-xl hover:bg-zinc-200 transition-colors focus:ring-2 focus:ring-zinc-200 focus:outline-none">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-md transition-colors focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none">
                            Simpan Paket
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const displayInput = document.getElementById('harga_display');
            const hiddenInput = document.getElementById('harga_actual');

            function formatRupiah(angka) {
                if (!angka) return '';
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            // Jika ada old input saat gagal validasi
            if (hiddenInput.value) {
                displayInput.value = formatRupiah(hiddenInput.value);
            }

            displayInput.addEventListener('input', function(e) {
                let rawValue = this.value.replace(/\D/g, '');
                hiddenInput.value = rawValue;
                this.value = formatRupiah(rawValue);
            });
        });
    </script>
</x-app-layout>
