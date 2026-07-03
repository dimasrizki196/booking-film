<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            Kelola Pesanan: <span class="text-[#FCBF49]">{{ $pemesanan->user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

            <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST" class="space-y-8"
                x-data="{ status: '{{ old('status_pemesanan', $pemesanan->status_pemesanan) }}' }">
                @csrf
                @method('PUT')

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

                <div class="bg-zinc-50 p-6 rounded-2xl border border-zinc-200">
                    <label class="block text-sm font-bold text-zinc-900 uppercase tracking-wider mb-2">
                        Status Pemesanan Saat Ini
                    </label>
                    <select name="status_pemesanan" x-model="status"
                        class="w-full rounded-xl border-zinc-300 bg-white py-3.5 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 font-extrabold text-zinc-800 shadow-sm">
                        <option value="pending">Pending (Menunggu Konfirmasi)</option>
                        <option value="diproses">Diproses (Jadwalkan Produksi)</option>
                        <option value="selesai">Selesai (Project Tuntas)</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>

                <div class="border-t border-zinc-200 pt-8 transition-all duration-300" x-show="status !== 'dibatalkan'">
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

                <div class="border-t border-red-200 pt-8 transition-all duration-300" x-show="status === 'dibatalkan'"
                    style="display: none;">
                    <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-red-900 tracking-tight">Catatan Pembatalan Pesanan</h3>
                            <p class="text-sm text-red-700 mt-0.5">
                                Berikan alasan pembatalan ini (misalnya jadwal penuh, request tidak sesuai, atau
                                permintaan pelanggan).
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-red-900 mb-2">Alasan Pembatalan dari
                                Admin</label>
                            <textarea name="alasan_batal" rows="3"
                                class="w-full rounded-xl border-red-200 bg-white py-3 px-4 focus:border-red-500 focus:ring-red-500 transition duration-200 text-zinc-800 shadow-sm"
                                placeholder="Tuliskan keterangan mengapa pesanan ini dibatalkan...">{{ old('alasan_batal', $pemesanan->alasan_batal ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

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
