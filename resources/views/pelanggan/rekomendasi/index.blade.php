<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kalkulator Estimasi Paket') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">

        <!-- OVERVIEW & FORM SECTION -->
        <div
            class="bg-white p-8 sm:p-12 rounded-[2rem] shadow-xl border border-zinc-100 mb-10 relative text-center overflow-hidden">
            <!-- Dekorasi Background -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#FCBF49] opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-zinc-900 opacity-5 rounded-full blur-3xl"></div>
            </div>

            <div class="mb-10 relative z-10 max-w-2xl mx-auto">
                <span
                    class="inline-block py-1.5 px-4 rounded-full bg-yellow-50 text-yellow-700 font-bold text-xs uppercase tracking-widest mb-4">
                    ✨ Smart Recommendation
                </span>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-zinc-900 tracking-tight leading-tight">
                    Karya Memukau, Sesuai <br> Kantong Anda.
                </h3>
                <p class="text-zinc-500 text-base font-medium mt-4 leading-relaxed max-w-lg mx-auto">
                    Beri tahu kami maksimal budget yang Anda siapkan. Algoritma kami akan langsung meracik semua pilihan
                    paket produksi terbaik yang bisa Anda dapatkan.
                </p>
            </div>

            <form action="{{ route('rekomendasi.proses') }}" method="POST" class="relative z-10 max-w-lg mx-auto">
                @csrf
                <div class="mb-6 text-left">
                    <label class="block text-sm font-bold text-zinc-700 mb-2 ml-2">Tentukan Maksimal Budget (Rp)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                            <span
                                class="text-zinc-400 font-black text-xl group-focus-within:text-[#FCBF49] transition-colors">Rp</span>
                        </div>
                        <input type="text" id="budget_display" inputmode="numeric"
                            value="{{ old('budget', $budget ?? '') }}"
                            class="w-full pl-16 rounded-2xl border-2 border-zinc-100 bg-zinc-50 py-4 px-6 focus:border-[#FCBF49] focus:ring-4 focus:ring-[#FCBF49]/10 transition-all duration-300 text-zinc-800 font-black text-2xl shadow-inner"
                            placeholder="Contoh: 5.000.000" required>
                        <input type="hidden" name="budget" id="budget_actual"
                            value="{{ old('budget', $budget ?? '') }}">
                    </div>
                </div>

                <button type="submit"
                    class="w-full inline-flex justify-center items-center px-8 py-4 bg-[#FCBF49] border border-transparent rounded-2xl font-black text-zinc-950 uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-500/30 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari Paket Terbaik
                </button>
            </form>
        </div>

        <!-- HASIL PENCARIAN REKOMENDASI -->
        @if (request()->isMethod('post'))

            @php
                // Memastikan data di-convert menjadi collection agar bisa dihitung dan dipisah
                $rekomendasiCol = isset($rekomendasi) ? collect($rekomendasi) : collect([]);
            @endphp

            @if ($rekomendasiCol->count() > 0)

                @php
                    // Memisahkan paket terbaik (yang paling mahal tapi masih masuk budget) dengan opsi lainnya
                    $bestMatch = $rekomendasiCol->first();
                    $alternatives = $rekomendasiCol->skip(1);
                @endphp

                <div class="mb-8 text-center animate-fade-in-up">
                    <h3 class="text-2xl font-black text-zinc-900 tracking-tight">Rekomendasi Berhasil Ditemukan!</h3>
                    <p class="text-zinc-500 mt-2 font-medium">Terdapat <strong
                            class="text-zinc-800">{{ $rekomendasiCol->count() }} paket</strong> yang sesuai dengan
                        budget Rp {{ number_format($budget, 0, ',', '.') }} Anda.</p>
                </div>

                <!-- 1. BEST MATCH CARD (Rekomendasi Paling Optimal) -->
                <div
                    class="bg-zinc-900 border border-zinc-800 p-8 rounded-3xl shadow-2xl relative overflow-hidden group animate-fade-in-up mb-10">
                    <div
                        class="absolute -right-20 -top-20 w-64 h-64 bg-[#FCBF49] rounded-full opacity-10 blur-3xl group-hover:opacity-20 transition-opacity duration-700 pointer-events-none">
                    </div>

                    <div
                        class="relative z-10 flex flex-col md:flex-row gap-8 justify-between items-start md:items-center">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="bg-[#FCBF49] text-zinc-950 text-xs font-black px-3 py-1.5 rounded-lg uppercase tracking-wider shadow-md">
                                    ⭐ Paling Optimal
                                </span>
                            </div>
                            <h4 class="font-black text-3xl sm:text-4xl text-white tracking-tight mb-3">
                                {{ $bestMatch->nama_paket }}
                            </h4>
                            <p class="text-zinc-400 leading-relaxed text-sm sm:text-base max-w-xl">
                                {{ $bestMatch->deskripsi }}
                            </p>
                        </div>

                        <div
                            class="w-full md:w-auto shrink-0 bg-zinc-800/50 backdrop-blur-sm border border-zinc-700 p-6 rounded-2xl flex flex-col items-center md:items-end text-center md:text-right">
                            <span class="text-xs text-zinc-400 font-bold uppercase tracking-wider mb-1">Harga
                                Paket</span>
                            <span class="text-[#FCBF49] font-black text-3xl mb-4">
                                Rp {{ number_format($bestMatch->harga, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-zinc-400 font-bold uppercase tracking-wider mb-1">Estimasi
                                Pengerjaan</span>
                            <span class="text-white font-bold text-lg mb-6">
                                {{ $bestMatch->durasi_pengerjaan }} Hari Kerja
                            </span>
                            <a href="{{ route('booking.create', ['paket_id' => $bestMatch->id]) }}"
                                class="inline-flex justify-center items-center px-8 py-3.5 bg-[#FCBF49] text-zinc-900 font-black rounded-xl text-sm uppercase tracking-widest hover:bg-yellow-500 transition-all shadow-lg hover:scale-105 w-full">
                                BOOKING PAKET INI
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 2. ALTERNATIVE CARDS (Jika ada lebih dari 1 paket yang masuk budget) -->
                @if ($alternatives->count() > 0)
                    <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-center gap-4 mb-6">
                            <div class="h-px bg-zinc-200 flex-1"></div>
                            <h4 class="text-sm font-bold text-zinc-400 uppercase tracking-widest text-center">Opsi
                                Lainnya Sesuai Budget</h4>
                            <div class="h-px bg-zinc-200 flex-1"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($alternatives as $paket)
                                <div
                                    class="bg-white border border-zinc-100 p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-black text-xl text-zinc-900 mb-2">{{ $paket->nama_paket }}</h4>
                                        <p class="text-sm text-zinc-500 line-clamp-2 mb-4">{{ $paket->deskripsi }}</p>
                                    </div>
                                    <div class="pt-4 border-t border-zinc-50 flex items-center justify-between">
                                        <div>
                                            <p class="text-xs font-bold text-zinc-400 uppercase">Harga</p>
                                            <p class="text-lg font-black text-zinc-900">Rp
                                                {{ number_format($paket->harga, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="{{ route('booking.create', ['paket_id' => $paket->id]) }}"
                                            class="px-5 py-2.5 bg-zinc-900 hover:bg-zinc-800 text-[#FCBF49] text-xs font-bold uppercase tracking-wider rounded-xl transition shadow-md">
                                            Pilih
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @elseif(isset($upsell))
                <!-- JIKA BUDGET TERLALU KECIL (Tampilkan Upsell) -->
                <div
                    class="bg-red-50/50 border border-red-100 p-8 rounded-3xl shadow-sm animate-fade-in-up text-center max-w-3xl mx-auto">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-zinc-900 mb-2">Budget Belum Mencukupi</h3>
                    <p class="text-zinc-600 font-medium text-sm sm:text-base mb-8 max-w-lg mx-auto">
                        Sayang sekali, budget <span class="font-bold text-zinc-900">Rp
                            {{ number_format($budget, 0, ',', '.') }}</span> belum mencukupi untuk paket standar kami.
                        Namun, hanya dengan sedikit tambahan, Anda bisa mendapatkan:
                    </p>

                    <div
                        class="bg-white p-6 rounded-2xl border border-red-100 shadow-md text-left flex flex-col sm:flex-row justify-between items-center gap-6">
                        <div>
                            <span class="text-xs font-black text-red-500 uppercase tracking-wider mb-1 block">Paket
                                Paling Terjangkau</span>
                            <h4 class="font-black text-2xl text-zinc-900 mb-1">{{ $upsell->nama_paket }}</h4>
                            <p class="text-zinc-500 text-sm">Tambahan yang dibutuhkan: <span
                                    class="font-bold text-red-500">Rp
                                    {{ number_format($upsell->harga - $budget, 0, ',', '.') }}</span></p>
                        </div>
                        <div class="w-full sm:w-auto text-right shrink-0">
                            <p class="text-3xl font-black text-[#FCBF49] mb-3">Rp
                                {{ number_format($upsell->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('booking.create', ['paket_id' => $upsell->id]) }}"
                                class="block w-full text-center bg-zinc-900 text-white font-bold px-8 py-3 rounded-xl hover:bg-zinc-800 transition shadow-lg">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endif

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
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>
