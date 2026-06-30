<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Edit Paket Layanan') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Nama Paket</label>
                        <input type="text" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                            placeholder="Contoh: Paket Prewedding Cinematic" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Deskripsi Paket</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800"
                            placeholder="Jelaskan detail apa saja yang didapatkan klien..." required>{{ old('deskripsi', $paket->deskripsi) }}</textarea>
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
                                    placeholder="Contoh: 5.000.000" required>
                                <input type="hidden" name="harga" id="harga_actual"
                                    value="{{ old('harga', $paket->harga ?? '') }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Durasi Pengerjaan (Hari)</label>
                            <input type="number" name="durasi_pengerjaan"
                                value="{{ old('durasi_pengerjaan', $paket->durasi_pengerjaan) }}"
                                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                                placeholder="Contoh: 7" required>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 mt-6 border-t border-zinc-100">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            PERBARUI
                        </button>
                        <a href="{{ route('admin.paket.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 uppercase tracking-widest hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            BATAL
                        </a>
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
