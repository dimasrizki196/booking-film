<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kalkulator Estimasi Paket Film') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">

        <!-- PERBAIKAN: Menghapus overflow-hidden dari pembungkus utama ini -->
        <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-zinc-100 mb-8 relative">

            <!-- Membungkus ornamen dekoratif agar tetap rapi melengkung tanpa memotong dropdown -->
            <div class="absolute inset-0 overflow-hidden rounded-3xl pointer-events-none">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FCBF49] opacity-5 rounded-bl-full"></div>
            </div>

            <div class="mb-6 relative z-10">
                <h3 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Temukan Paket yang Tepat Untuk Anda</h3>
                <p class="text-zinc-500 text-sm font-medium mt-1">Beritahu kami budget dan waktu Anda, sistem kami akan
                    mencarikan mahakarya yang paling sesuai.</p>
            </div>

            <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-6 relative z-10">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Berapa maksimal budget yang Anda siapkan?
                        (Rp)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-zinc-400 font-bold">Rp</span>
                        </div>

                        <input type="text" id="budget_display" inputmode="numeric"
                            value="{{ old('budget', $budget ?? '') }}"
                            class="w-full pl-12 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-bold text-lg"
                            placeholder="Contoh: 5.000.000" required>

                        <input type="hidden" name="budget" id="budget_actual"
                            value="{{ old('budget', $budget ?? '') }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Seberapa mendesak kebutuhan proyek
                        ini?</label>

                    <!-- CUSTOM RICH DROPDOWN SELECTION -->
                    <div x-data="{
                        open: false,
                        selectedId: '{{ old('waktu', $waktu ?? 'santai') }}',
                        selectedName: 'Santai',
                        selectedDetails: 'Bisa lebih dari 7 hari pengerjaan',
                        init() {
                            this.$nextTick(() => {
                                let activeEl = document.getElementById('waktu-option-' + this.selectedId);
                                if (activeEl) {
                                    this.selectedName = activeEl.dataset.name;
                                    this.selectedDetails = activeEl.dataset.details;
                                }
                            });
                        },
                        selectItem(id, name, details) {
                            this.selectedId = id;
                            this.selectedName = name;
                            this.selectedDetails = details;
                            this.open = false;
                        }
                    }" class="relative">

                        <input type="hidden" name="waktu" :value="selectedId" required>

                        <button type="button" @click="open = !open" @click.away="open = false"
                            :class="open ? 'border-[#FCBF49] ring-2 ring-[#FCBF49]/20 bg-white' :
                                'border-zinc-200 bg-zinc-50 hover:border-[#FCBF49]/50'"
                            class="w-full relative flex items-center justify-between rounded-2xl border py-3 px-5 text-left transition-all duration-200 focus:outline-none">
                            <div class="flex flex-col">
                                <span class="font-bold text-zinc-900 text-base" x-text="selectedName"></span>
                                <span class="text-xs font-bold text-[#FCBF49] mt-0.5" x-text="selectedDetails"></span>
                            </div>
                            <svg class="h-5 w-5 text-zinc-400 transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Menu Panel Dropdown -->
                        <div x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-50 mt-2 w-full rounded-2xl bg-white shadow-xl border border-zinc-100 py-2 max-h-60 overflow-y-auto no-scrollbar">

                            <ul class="flex flex-col text-left">
                                <li id="waktu-option-santai" data-name="Santai"
                                    data-details="Bisa lebih dari 7 hari pengerjaan"
                                    @click="selectItem('santai', 'Santai', 'Bisa lebih dari 7 hari pengerjaan')"
                                    class="relative cursor-pointer select-none py-3 px-5 hover:bg-zinc-50 transition-colors border-b border-zinc-50 last:border-0"
                                    :class="selectedId == 'santai' ? 'bg-zinc-50' : ''">
                                    <div>
                                        <span class="block font-bold"
                                            :class="selectedId == 'santai' ? 'text-zinc-900' : 'text-zinc-700'">Santai</span>
                                        <span class="block text-xs font-medium text-zinc-400 mt-0.5">Bisa lebih dari 7
                                            hari pengerjaan</span>
                                    </div>
                                </li>

                                <li id="waktu-option-cepat" data-name="Sangat Mendesak"
                                    data-details="Harus selesai di bawah 7 hari"
                                    @click="selectItem('cepat', 'Sangat Mendesak', 'Harus selesai di bawah 7 hari')"
                                    class="relative cursor-pointer select-none py-3 px-5 hover:bg-zinc-50 transition-colors border-b border-zinc-50 last:border-0"
                                    :class="selectedId == 'cepat' ? 'bg-zinc-50' : ''">
                                    <div>
                                        <span class="block font-bold"
                                            :class="selectedId == 'cepat' ? 'text-zinc-900' : 'text-zinc-700'">Sangat
                                            Mendesak</span>
                                        <span class="block text-xs font-bold text-red-500 mt-0.5">Harus selesai di bawah
                                            7 hari</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-zinc-900 border border-transparent rounded-xl font-extrabold text-sm text-[#FCBF49] uppercase tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        CARI REKOMENDASI
                    </button>
                </div>
            </form>
        </div>

        @if (isset($rekomendasi))
            <div
                class="bg-zinc-900 border border-zinc-800 p-6 sm:p-8 rounded-3xl shadow-2xl relative overflow-hidden group animate-fade-in-up">
                <div
                    class="absolute -right-20 -top-20 w-64 h-64 bg-[#FCBF49] rounded-full opacity-10 blur-3xl group-hover:opacity-20 transition-opacity duration-700 pointer-events-none">
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#FCBF49]/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#FCBF49]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-[#FCBF49] tracking-tight">Rekomendasi Terbaik
                            Untuk Anda!</h3>
                    </div>

                    <p class="text-zinc-400 font-medium mb-6">Berdasarkan budget dan waktu Anda, ini adalah paket
                        mahakarya yang paling sesuai:</p>

                    <div class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700/50 p-6 rounded-2xl shadow-inner">
                        <h4 class="font-black text-2xl text-white tracking-tight mb-2">{{ $rekomendasi->nama_paket }}
                        </h4>
                        <p class="text-zinc-400 leading-relaxed text-sm mb-6">{{ $rekomendasi->deskripsi }}</p>

                        <div class="flex flex-col sm:flex-row gap-3 mb-8">
                            <div
                                class="bg-zinc-900 border border-zinc-700 px-4 py-3 rounded-xl flex flex-col justify-center">
                                <span class="text-xs text-zinc-500 font-bold uppercase tracking-wider mb-1">Harga
                                    Paket</span>
                                <span class="text-[#FCBF49] font-black text-lg">Rp
                                    {{ number_format($rekomendasi->harga, 0, ',', '.') }}</span>
                            </div>
                            <div
                                class="bg-zinc-900 border border-zinc-700 px-4 py-3 rounded-xl flex flex-col justify-center">
                                <span class="text-xs text-zinc-500 font-bold uppercase tracking-wider mb-1">Estimasi
                                    Waktu</span>
                                <span class="text-white font-bold text-lg">{{ $rekomendasi->durasi_pengerjaan }}
                                    Hari</span>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('booking.create') }}"
                                class="inline-flex justify-center items-center px-8 py-4 bg-[#FCBF49] text-zinc-900 font-black rounded-xl text-sm uppercase tracking-widest hover:bg-yellow-500 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 w-full sm:w-auto">
                                BOOKING PAKET INI
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(request()->isMethod('post'))
            <div
                class="bg-red-50 p-6 sm:p-8 rounded-3xl border border-red-100 shadow-sm flex items-start gap-4 animate-fade-in-up">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-red-800 mb-1">Mohon Maaf, Paket Tidak Ditemukan</h3>
                    <p class="text-sm text-red-700 font-medium leading-relaxed">
                        Kami tidak dapat menemukan paket yang sesuai dengan kriteria Anda. Hal ini biasanya terjadi jika
                        budget yang diinputkan berada di bawah batas minimum untuk target waktu yang sangat cepat.
                        Silakan sesuaikan kembali nominal budget atau estimasi waktu Anda.
                    </p>
                </div>
            </div>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const displayInput = document.getElementById('budget_display');
            const hiddenInput = document.getElementById('budget_actual');

            if (displayInput.value) {
                let rawValue = displayInput.value.replace(/\D/g, '');
                displayInput.value = formatRupiah(rawValue);
                hiddenInput.value = rawValue;
            }

            displayInput.addEventListener('input', function(e) {
                let rawValue = this.value.replace(/\D/g, '');
                hiddenInput.value = rawValue;
                this.value = formatRupiah(rawValue);
            });

            function formatRupiah(angka) {
                if (!angka) return '';
                return new Intl.NumberFormat('id-ID').format(angka);
            }
        });
    </script>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>
