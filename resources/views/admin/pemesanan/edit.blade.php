<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pesanan: {{ $pemesanan->user->name }}</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            
            <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="bg-gray-50 p-4 rounded mb-6 border">
                    <p class="text-sm text-gray-600"><strong>Paket Pilihan:</strong> {{ $pemesanan->paket->nama_paket }}</p>
                    <p class="text-sm text-gray-600"><strong>Tanggal Request Klien:</strong> {{ \Carbon\Carbon::parse($pemesanan->tanggal_pengerjaan)->format('d M Y') }}</p>
                    <p class="text-sm text-gray-600"><strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status Pemesanan</label>
                    <select name="status_pemesanan" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="pending" {{ $pemesanan->status_pemesanan == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $pemesanan->status_pemesanan == 'diproses' ? 'selected' : '' }}>Diproses (Jadwalkan Produksi)</option>
                        <option value="selesai" {{ $pemesanan->status_pemesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $pemesanan->status_pemesanan == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <hr class="my-6">

                <h3 class="text-lg font-bold text-gray-700 mb-4">Atur Jadwal Produksi</h3>
                <p class="text-sm text-gray-500 mb-4">Isi form di bawah ini jika status pesanan diubah menjadi <strong>Diproses</strong>.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai Produksi</label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pemesanan->jadwal->tanggal_mulai ?? '') }}" class="w-full border-gray-300 rounded shadow-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai Produksi</label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $pemesanan->jadwal->tanggal_selesai ?? '') }}" class="w-full border-gray-300 rounded shadow-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi Produksi</label>
                    <input type="text" name="lokasi_produksi" value="{{ old('lokasi_produksi', $pemesanan->jadwal->lokasi_produksi ?? '') }}" class="w-full border-gray-300 rounded shadow-sm">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Catatan Tambahan Produksi (Opsional)</label>
                    <textarea name="keterangan" rows="3" class="w-full border-gray-300 rounded shadow-sm">{{ old('keterangan', $pemesanan->jadwal->keterangan ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded transition">Simpan Perubahan</button>
                    <a href="{{ route('admin.pemesanan.index') }}" class="text-gray-500 hover:text-gray-800 text-sm">Kembali</a>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>