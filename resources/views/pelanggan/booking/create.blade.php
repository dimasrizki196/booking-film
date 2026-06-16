<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat Pesanan Baru</h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Paket Layanan</label>
                    <select name="paket_id" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="" disabled selected>-- Pilih Paket Film --</option>
                        @foreach($paket as $p)
                            <option value="{{ $p->id }}" {{ old('paket_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }} - Rp {{ number_format($p->harga, 0, ',', '.') }} (Estimasi: {{ $p->durasi_pengerjaan }} Hari)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pengambilan Gambar / Produksi</label>
                    <input type="date" name="tanggal_pengerjaan" value="{{ old('tanggal_pengerjaan') }}" min="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <p class="text-xs text-gray-500 mt-1">Pilih estimasi tanggal dimulainya project. Jadwal pasti akan dikonfirmasi oleh admin.</p>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded transition w-full md:w-auto">
                        Booking Sekarang
                    </button>
                    <a href="{{ route('booking.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Batal</a>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>