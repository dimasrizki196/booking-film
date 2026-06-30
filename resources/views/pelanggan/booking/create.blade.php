<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Buat Pesanan Baru') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-2xl animate-fade-in-up">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pada input Anda:</h3>
                    </div>
                    <ul class="list-disc pl-5 text-sm text-red-700 font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Pilihan Paket (Dropdown Alpine kustom dari Fajar) -->
                <div>
                    <label class="block text-lg font-extrabold text-zinc-900 mb-4 tracking-tight">1. Pilih Paket
                        Mahakarya Anda</label>

                    <div x-data="{
                        open: false,
                        selectedId: '{{ old('paket_id') }}',
                        selectedName: 'Silahkan Pilih Paket Film',
                        selectedDetails: 'Klik untuk melihat pilihan paket',
                        init() {
                            this.$nextTick(() => {
                                if (this.selectedId) {
                                    let activeEl = document.getElementById('option-' + this.selectedId);
                                    if (activeEl) {
                                        this.selectedName = activeEl.dataset.name;
                                        this.selectedDetails = activeEl.dataset.details;
                                    }
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

                        <input type="hidden" name="paket_id" :value="selectedId" required>

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

                        <div x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-50 mt-2 w-full rounded-2xl bg-white shadow-xl border border-zinc-100 py-2 max-h-60 overflow-auto no-scrollbar">

                            <ul class="flex flex-col text-left">
                                @foreach ($paket as $p)
                                    <li id="option-{{ $p->id }}" data-name="{{ $p->nama_paket }}"
                                        data-details="Rp {{ number_format($p->harga, 0, ',', '.') }} &bull; Estimasi: {{ $p->durasi_pengerjaan }} Hari"
                                        @click="selectItem('{{ $p->id }}', '{{ addslashes($p->nama_paket) }}', 'Rp {{ number_format($p->harga, 0, ',', '.') }} &bull; Estimasi: {{ $p->durasi_pengerjaan }} Hari')"
                                        class="relative cursor-pointer select-none py-3 px-5 hover:bg-zinc-50 transition-colors border-b border-zinc-50 last:border-0"
                                        :class="selectedId == '{{ $p->id }}' ? 'bg-zinc-50' : ''">

                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="block font-bold"
                                                    :class="selectedId == '{{ $p->id }}' ? 'text-zinc-900' :
                                                        'text-zinc-700'">
                                                    {{ $p->nama_paket }}
                                                </span>
                                                <span class="block text-xs font-bold text-[#FCBF49] mt-1">
                                                    Rp {{ number_format($p->harga, 0, ',', '.') }} <span
                                                        class="text-zinc-400 font-medium ml-1">&bull; Estimasi
                                                        {{ $p->durasi_pengerjaan }} Hari</span>
                                                </span>
                                            </div>

                                            <span x-show="selectedId == '{{ $p->id }}'" style="display: none;"
                                                class="text-[#FCBF49]">
                                                <svg class="h-5 w-5 font-bold" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tanggal Pengerjaan (H-3 Fix) -->
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Pengambilan Gambar /
                        Produksi</label>
                    <input type="date" name="tanggal_pengerjaan" value="{{ old('tanggal_pengerjaan') }}"
                        min="{{ $minDate ?? \Carbon\Carbon::now()->addDays(3)->format('Y-m-d') }}"
                        class="w-full sm:w-1/2 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                        required>
                    <p class="text-xs text-zinc-500 font-medium mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-zinc-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pemesanan minimal dilakukan H-3. Jadwal pasti akan dikonfirmasi oleh admin.
                    </p>
                </div>

                <!-- Form Catatan Customer (Dimunculkan Kembali) -->
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan_customer" rows="4"
                        placeholder="Misal: Saya ingin video bergaya vintage, atau lokasi syuting di kafe XYZ..."
                        class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium">{{ old('catatan_customer') }}</textarea>
                </div>

                <!-- Tombol Action -->
                <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 mt-6 border-t border-zinc-100">
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-zinc-900 border border-transparent rounded-xl font-extrabold text-sm text-[#FCBF49] uppercase tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        BOOKING SEKARANG
                    </button>
                    <a href="{{ route('booking.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 uppercase tracking-widest hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        BATAL
                    </a>
                </div>
            </form>

        </div>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Menyembunyikan scrollbar pada dropdown menu */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>
