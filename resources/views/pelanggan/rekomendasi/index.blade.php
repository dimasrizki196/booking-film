<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kalkulator Estimasi Paket Film') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white p-6 sm:p-10 rounded-3xl shadow-xl border border-zinc-100 mb-8 relative text-center">
            <div class="absolute inset-0 overflow-hidden rounded-3xl pointer-events-none">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#FCBF49] opacity-5 rounded-bl-full"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-zinc-900 opacity-5 rounded-tr-full"></div>
            </div>

            <div class="mb-8 relative z-10 max-w-2xl mx-auto">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight">Karya Memukau, Sesuai
                    Kantong Anda.</h3>
                <p class="text-zinc-500 text-sm sm:text-base font-medium mt-3">
                    Beri tahu kami seberapa besar budget yang Anda miliki, dan algoritma kami akan meracik rekomendasi
                    paket produksi terbaik untuk mahakarya Anda.
                </p>
            </div>

            <form action="{{ route('rekomendasi.proses') }}" method="POST" class="relative z-10 max-w-xl mx-auto">
                @csrf
                <div class="mb-6 text-left">
                    <label class="block text-sm font-bold text-zinc-700 mb-2 ml-1">Maksimal Budget Anda (Rp)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <span class="text-zinc-400 font-bold text-xl">Rp</span>
                        </div>
                        <input type="text" id="budget_display" inputmode="numeric"
                            value="{{ old('budget', $budget ?? '') }}"
                            class="w-full pl-14 rounded-2xl border-zinc-200 bg-zinc-50 py-4 px-5 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-black text-2xl shadow-inner"
                            placeholder="Contoh: 5.000.000" required>
                        <input type="hidden" name="budget" id="budget_actual"
                            value="{{ old('budget', $budget ?? '') }}">
                    </div>
                </div>

                <button type="submit"
                    class="w-full inline-flex justify-center items-center px-8 py-4 bg-zinc-900 border border-transparent rounded-2xl font-extrabold text-base text-[#FCBF49] uppercase tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-[#FCBF49] transition ease-in-out duration-150 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    CARI PAKET TERBAIK
                </button>
            </form>
        </div>

        @if (request()->isMethod('post'))

            @if (isset($rekomendasi))
                <div
                    class="bg-zinc-900 border border-zinc-800 p-6 sm:p-8 rounded-3xl shadow-2xl relative overflow-hidden group animate-fade-in-up mb-6">
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
                            <h3 class="text-xl sm:text-2xl font-extrabold text-[#FCBF49] tracking-tight">Rekomendasi
                                Utama!</h3>
                        </div>

                        <div
                            class="bg-zinc-800/50 backdrop-blur-sm border border-zinc-700/50 p-6 rounded-2xl shadow-inner">
                            <h4 class="font-black text-3xl text-white tracking-tight mb-2">
                                {{ $rekomendasi->nama_paket }}</h4>
                            <p class="text-zinc-400 leading-relaxed text-sm mb-6">{{ $rekomendasi->deskripsi }}</p>

                            <div class="flex flex-col sm:flex-row gap-3 mb-8">
                                <div
                                    class="bg-zinc-900 border border-zinc-700 px-5 py-4 rounded-xl flex flex-col justify-center">
                                    <span class="text-xs text-zinc-500 font-bold uppercase tracking-wider mb-1">Harga
                                        Paket</span>
                                    <span class="text-[#FCBF49] font-black text-xl">Rp
                                        {{ number_format($rekomendasi->harga, 0, ',', '.') }}</span>
                                </div>
                                <div
                                    class="bg-zinc-900 border border-zinc-700 px-5 py-4 rounded-xl flex flex-col justify-center">
                                    <span class="text-xs text-zinc-500 font-bold uppercase tracking-wider mb-1">Durasi
                                        Pengerjaan</span>
                                    <span class="text-white font-bold text-xl">{{ $rekomendasi->durasi_pengerjaan }}
                                        Hari</span>
                                </div>
                            </div>

                            <a href="{{ route('booking.create') }}"
                                class="inline-flex justify-center items-center px-8 py-4 bg-[#FCBF49] text-zinc-900 font-black rounded-xl text-sm uppercase tracking-widest hover:bg-yellow-500 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 w-full sm:w-auto">
                                BOOKING PAKET INI
                            </a>
                        </div>
                    </div>
                </div>

                @if (isset($upsell))
                    <div class="bg-white border-2 border-dashed border-[#FCBF49] p-6 rounded-3xl shadow-md relative animate-fade-in-up"
                        style="animation-delay: 0.2s;">
                        <div
                            class="absolute -top-3 left-6 bg-[#FCBF49] text-zinc-900 text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                            ✨ Opsi Upgrade
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 mt-2">
                            <div>
                                <h4 class="font-bold text-lg text-zinc-900">{{ $upsell->nama_paket }}</h4>
                                <p class="text-sm text-zinc-500 mt-1">
                                    Hanya dengan tambahan <span class="font-bold text-zinc-900">Rp
                                        {{ number_format($upsell->harga - $budget, 0, ',', '.') }}</span> dari budget
                                    Anda, tingkatkan kualitas produksi Anda ke level selanjutnya.
                                </p>
                            </div>
                            <a href="{{ route('booking.create') }}"
                                class="shrink-0 bg-white border-2 border-zinc-200 text-zinc-800 font-bold px-6 py-3 rounded-xl hover:border-zinc-900 hover:bg-zinc-900 hover:text-white transition-all text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endif
            @elseif(isset($upsell))
                <div class="bg-blue-50 border border-blue-100 p-6 sm:p-8 rounded-3xl shadow-sm animate-fade-in-up">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-blue-900">Sedikit Lagi Sampai!</h3>
                    </div>
                    <p class="text-blue-800 text-sm mb-6">
                        Budget Anda belum cukup untuk saat ini, namun jangan khawatir! Hanya dengan tambahan <span
                            class="font-bold">Rp {{ number_format($upsell->harga - $budget, 0, ',', '.') }}</span>,
                        Anda sudah bisa menikmati paket dasar kami.
                    </p>

                    <div
                        class="bg-white p-5 rounded-2xl border border-blue-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div>
                            <h4 class="font-bold text-zinc-900">{{ $upsell->nama_paket }}</h4>
                            <p class="text-[#FCBF49] font-black">Rp {{ number_format($upsell->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <a href="{{ route('booking.create') }}"
                            class="bg-zinc-900 text-white font-bold px-6 py-2.5 rounded-xl hover:bg-zinc-800 transition text-sm w-full sm:w-auto text-center">
                            Booking Sekarang
                        </a>
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
    </style>
</x-app-layout>
