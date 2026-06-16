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
                <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-2xl">
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

            <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Pilih Paket Layanan</label>
                    <select name="paket_id"
                        class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 font-medium text-zinc-800 cursor-pointer"
                        required>
                        <option value="" disabled selected>-- Pilih Paket Film --</option>
                        @foreach ($paket as $p)
                            <option value="{{ $p->id }}" {{ old('paket_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }} - Rp {{ number_format($p->harga, 0, ',', '.') }} (Estimasi:
                                {{ $p->durasi_pengerjaan }} Hari)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Pengambilan Gambar /
                        Produksi</label>
                    <input type="date" name="tanggal_pengerjaan" value="{{ old('tanggal_pengerjaan') }}"
                        min="{{ date('Y-m-d') }}"
                        class="w-full sm:w-1/2 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium"
                        required>
                    <p class="text-xs text-zinc-500 font-medium mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-zinc-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pilih estimasi tanggal dimulainya project. Jadwal pasti akan dikonfirmasi oleh admin.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 mt-6 border-t border-zinc-100">
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 bg-zinc-900 border border-transparent rounded-xl font-extrabold text-sm text-[#FCBF49] uppercase tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        Booking Sekarang
                    </button>
                    <a href="{{ route('booking.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 uppercase tracking-widest hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
