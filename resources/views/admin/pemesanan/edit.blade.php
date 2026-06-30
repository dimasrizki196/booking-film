<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            Kelola Pesanan: <span class="text-[#FCBF49]">{{ $pemesanan->user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

            <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-zinc-50 p-6 rounded-2xl mb-8 border border-zinc-200 shadow-sm">
                    <h3 class="text-sm font-bold text-zinc-400 uppercase tracking-wider mb-4">Ringkasan Pesanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs font-semibold text-zinc-500 uppercase">Paket Pilihan</p>
                            <p class="text-base font-bold text-zinc-900 mt-1">{{ $pemesanan->paket->nama_paket }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-zinc-500 uppercase">Tgl Request Klien</p>
                            <p class="text-base font-bold text-zinc-900 mt-1">
                                {{ \Carbon\Carbon::parse($pemesanan->tanggal_pengerjaan)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-zinc-500 uppercase">Total Harga</p>
                            <p class="text-lg font-extrabold text-[#FCBF49] mt-1">Rp
                                {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Status Pemesanan</label>
                    <select name="status_pemesanan"
                        class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 font-bold text-zinc-800">
                        <option value="pending" {{ $pemesanan->status_pemesanan == 'pending' ? 'selected' : '' }}>
                            Pending</option>
                        <option value="diproses" {{ $pemesanan->status_pemesanan == 'diproses' ? 'selected' : '' }}>
                            Diproses (Jadwalkan Produksi)</option>
                        <option value="selesai" {{ $pemesanan->status_pemesanan == 'selesai' ? 'selected' : '' }}>
                            Selesai</option>
                        <option value="dibatalkan" {{ $pemesanan->status_pemesanan == 'dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan</option>
                    </select>
                </div>

                <hr class="my-8 border-t border-zinc-100">

                <div>
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight mb-2">Atur Jadwal Produksi</h3>
                    <p class="text-sm font-medium text-zinc-500 mb-6">Isi form di bawah ini jika status pesanan diubah
                        menjadi <span class="font-bold text-zinc-800">Diproses</span>.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Mulai Produksi</label>
                            <input type="date" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $pemesanan->jadwal->tanggal_mulai ?? '') }}"
                                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Selesai Produksi</label>
                            <input type="date" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai', $pemesanan->jadwal->tanggal_selesai ?? '') }}"
                                class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Lokasi Produksi</label>
                        <input type="text" name="lokasi_produksi"
                            value="{{ old('lokasi_produksi', $pemesanan->jadwal->lokasi_produksi ?? '') }}"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800"
                            placeholder="Contoh: Studio Utama / Nama Lokasi Outdoor">
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Catatan Tambahan Produksi
                            (Opsional)</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800"
                            placeholder="Tambahkan catatan khusus untuk tim produksi...">{{ old('keterangan', $pemesanan->jadwal->keterangan ?? '') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-zinc-100">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-xl font-extrabold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        SIMPAN PERUBAHAN
                    </button>
                    <a href="{{ route('admin.pemesanan.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 tracking-widest hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        KEMBALI
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
