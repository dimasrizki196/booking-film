<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kalkulator Estimasi Paket Film</h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-8">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Temukan Paket yang Tepat Untuk Anda</h3>
            
            <form action="{{ route('rekomendasi.proses') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Berapa maksimal budget yang Anda siapkan? (Rp)</label>
                    <input type="number" name="budget" value="{{ old('budget', $budget ?? '') }}" placeholder="Contoh: 5000000" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Seberapa mendesak kebutuhan proyek ini?</label>
                    <select name="waktu" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="santai" {{ (isset($waktu) && $waktu == 'santai') ? 'selected' : '' }}>Santai (Bisa lebih dari 7 hari pengerjaan)</option>
                        <option value="cepat" {{ (isset($waktu) && $waktu == 'cepat') ? 'selected' : '' }}>Sangat Mendesak (Harus selesai di bawah 7 hari)</option>
                    </select>
                </div>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded transition w-full md:w-auto">
                    Cari Rekomendasi
                </button>
            </form>
        </div>

        @if(isset($rekomendasi))
            <div class="bg-green-50 p-6 shadow-sm sm:rounded-lg border border-green-200">
                <h3 class="text-xl font-bold text-green-800 mb-2">🎉 Rekomendasi Terbaik Untuk Anda!</h3>
                <p class="text-green-700 mb-4">Berdasarkan budget dan waktu Anda, ini adalah paket yang paling sesuai:</p>
                
                <div class="bg-white p-4 rounded shadow-sm">
                    <h4 class="font-bold text-lg text-gray-800">{{ $rekomendasi->nama_paket }}</h4>
                    <p class="text-gray-600 mt-2">{{ $rekomendasi->deskripsi }}</p>
                    
                    <div class="mt-4 flex gap-4">
                        <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded">Harga: Rp {{ number_format($rekomendasi->harga, 0, ',', '.') }}</span>
                        <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded">Estimasi: {{ $rekomendasi->durasi_pengerjaan }} Hari</span>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('booking.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded transition inline-block">
                            Booking Paket Ini
                        </a>
                    </div>
                </div>
            </div>
        @elseif(request()->isMethod('post'))
            <div class="bg-red-50 p-6 shadow-sm sm:rounded-lg border border-red-200">
                <h3 class="text-xl font-bold text-red-800 mb-2">Mohon Maaf</h3>
                <p class="text-red-700">Kami tidak dapat menemukan paket yang sesuai dengan kriteria Anda (Mungkin budget terlalu rendah untuk target waktu yang cepat). Silakan sesuaikan kembali budget atau estimasi waktu Anda.</p>
            </div>
        @endif

    </div>
</x-app-layout>