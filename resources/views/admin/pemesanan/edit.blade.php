<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 leading-tight">
            {{ __('Kelola Pesanan: ') . $pemesanan->user->name }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

            <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- 1. RINGKASAN & CATATAN PELANGGAN -->
                <div
                    class="bg-zinc-900 text-white p-6 sm:p-8 rounded-2xl border-l-4 border-[#FCBF49] shadow-md relative overflow-hidden">
                    <div class="flex items-center justify-between border-b border-zinc-800 pb-4 mb-6">
                        <h3 class="text-sm font-bold text-[#FCBF49] uppercase tracking-wider">Informasi & Request Klien
                        </h3>
                        <span class="text-xs font-semibold px-3 py-1 bg-zinc-800 rounded-full text-zinc-300">
                            ID Pesanan: #{{ $pemesanan->id }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <p class="text-xs font-medium text-zinc-400 uppercase">Paket Pilihan</p>
                            <p class="text-lg font-bold text-white mt-1">{{ $pemesanan->paket->nama_paket }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-zinc-400 uppercase">Tgl Request Klien</p>
                            <p class="text-lg font-bold text-white mt-1">
                                {{ \Carbon\Carbon::parse($pemesanan->tanggal_pengerjaan)->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-zinc-400 uppercase">Total Nilai Project</p>
                            <p class="text-xl font-extrabold text-[#FCBF49] mt-1">
                                Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- KOTAK KHUSUS CATATAN DARI PELANGGAN -->
                    <div class="bg-zinc-800/80 p-4 rounded-xl border border-zinc-700/60 mt-4">
                        <p class="text-xs font-bold text-zinc-400 uppercase mb-1">Catatan / Request Khusus Klien:</p>
                        <p class="text-sm font-medium text-zinc-200 italic leading-relaxed">
                            @if (!empty($pemesanan->catatan))
                                "{{ $pemesanan->catatan }}"
                            @else
                                <span class="text-zinc-500 not-italic">Pelanggan tidak memberikan catatan tambahan pada
                                    pesanan ini.</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- 2. UPDATE STATUS PESANAN -->
                <div class="bg-zinc-50 p-6 rounded-2xl border border-zinc-200">
                    <label class="block text-sm font-bold text-zinc-900 uppercase tracking-wider mb-2">
                        Status Pemesanan Saat Ini
                    </label>
                    <select name="status_pemesanan"
                        class="w-full rounded-xl border-zinc-300 bg-white py-3.5 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 font-extrabold text-zinc-800 shadow-sm">
                        <option value="pending" {{ $pemesanan->status_pemesanan == 'pending' ? 'selected' : '' }}>
                            Pending (Menunggu Konfirmasi)
                        </option>
                        <option value="diproses" {{ $pemesanan->status_pemesanan == 'diproses' ? 'selected' : '' }}>
                            Diproses (Jadwalkan Produksi)
                        </option>
                        <option value="selesai" {{ $pemesanan->status_pemesanan == 'selesai' ? 'selected' : '' }}>
                            Selesai (Project Tuntas)
                        </option>
                        <option value="dibatalkan"
                            {{ $pemesanan->status_pemesanan == 'dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>
                    </select>
                </div>

                <!-- 3. ATUR JADWAL & CATATAN PRODUKSI (ADMIN ONLY) -->
                <div class="border-t border-zinc-200 pt-8">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Atur Jadwal & Tim Produksi</h3>
                        <p class="text-sm font-medium text-zinc-500 mt-1">
                            Lengkapi data di bawah ini untuk mengatur alur kerja internal saat pesanan berstatus <span
                                class="font-bold text-zinc-800">Diproses</span>.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Mulai Produksi</label>
                            <input type="date" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $pemesanan->jadwal->tanggal_mulai ?? '') }}"
                                class="w-full rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-zinc-700 mb-2">Tanggal Selesai Produksi</label>
                            <input type="date" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai', $pemesanan->jadwal->tanggal_selesai ?? '') }}"
                                class="w-full rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium shadow-sm">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Lokasi Produksi</label>
                        <input type="text" name="lokasi_produksi"
                            value="{{ old('lokasi_produksi', $pemesanan->jadwal->lokasi_produksi ?? '') }}"
                            class="w-full rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 shadow-sm"
                            placeholder="Contoh: Studio Utama NextProject / Nama Lokasi Outdoor">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">
                            Catatan Internal Tim Produksi <span class="text-zinc-400 font-normal">(Opsional)</span>
                        </label>
                        <textarea name="keterangan" rows="3"
                            class="w-full rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 shadow-sm"
                            placeholder="Tambahkan instruksi khusus untuk kru lapangan, perlengkapan yang wajib dibawa, dsb...">{{ old('keterangan', $pemesanan->jadwal->keterangan ?? '') }}</textarea>
                    </div>
                </div>

                <!-- AKSI SUBMIT -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-zinc-100">
                    <a href="{{ route('admin.pemesanan.index') }}"
                        class="inline-flex items-center px-6 py-3.5 bg-zinc-100 border border-transparent rounded-xl font-bold text-sm text-zinc-700 hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3.5 bg-zinc-900 border border-transparent rounded-xl font-extrabold text-sm text-[#FCBF49] uppercase tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
