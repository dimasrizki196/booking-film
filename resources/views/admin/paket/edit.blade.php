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
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium leading-relaxed"
                            placeholder="Jelaskan gambaran umum tentang paket layanan ini..." required>{{ old('deskripsi', $paket->deskripsi ?? '') }}</textarea>
                        <p class="text-xs text-zinc-400 mt-1">Deskripsi umum berupa paragraf singkat yang akan muncul di
                            bawah harga pada kartu paket.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Detail Spesifikasi & Include Layanan
                            (Daftar Poin)</label>

                        <input type="hidden" name="detail_paket" id="hidden_detail_paket"
                            value="{{ old('detail_paket', $paket->detail_paket ?? '') }}">

                        <div id="list_container_detail" class="space-y-3 mb-3"></div>

                        <button type="button" id="btn_add_detail"
                            class="inline-flex items-center px-4 py-2.5 bg-[#FCBF49] hover:bg-yellow-500 text-zinc-950 text-xs font-bold rounded-xl transition shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Poin Spesifikasi
                        </button>
                        <p class="text-xs text-zinc-400 mt-2">Setiap poin yang Anda ketik akan otomatis disimpan dan
                            dimunculkan dengan ikon centang hijau di kartu paket.</p>
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
                                    value="{{ old('harga', $paket->harga) }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Durasi Pengerjaan (Hari)</label>
                            <input type="number" name="durasi_pengerjaan"
                                value="{{ old('durasi_pengerjaan', $paket->durasi_pengerjaan) }}"
                                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                                placeholder="Contoh: 7" required min="1">
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
            // --- 1. SCRIPT FORMAT RUPIAH ---
            const displayInput = document.getElementById('harga_display');
            const hiddenInput = document.getElementById('harga_actual');

            function formatRupiah(angka) {
                if (!angka) return '';
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            if (hiddenInput && hiddenInput.value) {
                displayInput.value = formatRupiah(hiddenInput.value);
            }

            if (displayInput) {
                displayInput.addEventListener('input', function(e) {
                    let rawValue = this.value.replace(/\D/g, '');
                    hiddenInput.value = rawValue;
                    this.value = formatRupiah(rawValue);
                });
            }

            // --- 2. SCRIPT DAFTAR POIN DINAMIS (SPESIFIKASI / DETAIL PAKET) ---
            const hiddenDetail = document.getElementById('hidden_detail_paket');
            const containerDetail = document.getElementById('list_container_detail');
            const btnAddDetail = document.getElementById('btn_add_detail');

            // Fungsi untuk menggabungkan semua inputan poin menjadi 1 teks (dipisah baris baru \n)
            function updateHiddenDetail() {
                const inputs = containerDetail.querySelectorAll('.detail-item-input');
                const values = [];
                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        values.push(input.value.trim());
                    }
                });
                // Simpan dengan pemisah baris baru agar cocok dengan explode("\n", ...) di kartu paket
                hiddenDetail.value = values.join('\n');
            }

            // Fungsi membuat baris input baru
            function createDetailRow(value = '') {
                const row = document.createElement('div');
                row.className = 'flex items-center gap-2';
                row.innerHTML = `
                    <div class="flex-1">
                        <input type="text" value="${value}"
                            class="detail-item-input w-full rounded-xl border-zinc-200 bg-zinc-50 py-2.5 px-4 text-sm font-medium focus:border-[#FCBF49] focus:ring-[#FCBF49] text-zinc-800 placeholder-zinc-400"
                            placeholder="Contoh: Kamera Sinematik 4K Resolution">
                    </div>
                    <button type="button" class="btn-remove-detail p-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition flex-shrink-0" title="Hapus Poin">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                `;

                const inputField = row.querySelector('.detail-item-input');
                const removeBtn = row.querySelector('.btn-remove-detail');

                // Saat diketik, langsung update input hidden
                inputField.addEventListener('input', updateHiddenDetail);

                // Saat tombol hapus diklik, hapus baris dan update input hidden
                removeBtn.addEventListener('click', function() {
                    row.remove();
                    updateHiddenDetail();
                });

                containerDetail.appendChild(row);
            }

            // Inisialisasi: Baca data yang sudah ada di database saat halaman dimuat
            if (hiddenDetail) {
                const initialDetails = hiddenDetail.value ? hiddenDetail.value.split('\n') : [];
                let addedCount = 0;
                initialDetails.forEach(item => {
                    if (item.trim() !== '') {
                        createDetailRow(item.trim());
                        addedCount++;
                    }
                });

                // Jika belum ada poin sama sekali, munculkan 1 baris kosong sebagai pancingan
                if (addedCount === 0) {
                    createDetailRow('');
                }
            }

            // Event saat tombol "+ Tambah Poin" diklik
            if (btnAddDetail) {
                btnAddDetail.addEventListener('click', function() {
                    createDetailRow('');
                });
            }
        });
    </script>
</x-app-layout>
