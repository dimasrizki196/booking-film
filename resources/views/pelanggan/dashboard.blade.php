<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="bg-gradient-to-br from-zinc-900 to-zinc-800 p-8 sm:p-10 rounded-3xl shadow-xl border border-zinc-700 relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-[#FCBF49] rounded-full opacity-20 blur-3xl"></div>
                <div class="absolute bottom-0 right-20 w-32 h-32 bg-blue-500 rounded-full opacity-20 blur-2xl"></div>

                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-white mb-3" style="font-family: 'Playfair Display', serif;">
                        Halo, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-zinc-300 text-lg mb-8 max-w-xl">
                        Terima kasih telah mempercayakan project Anda kepada NextProjectFilm. Temukan layanan terbaik
                        kami dan pantau pesanan Anda di sini.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('booking.index') }}"
                            class="bg-[#FCBF49] text-zinc-950 px-6 py-3 rounded-xl font-bold hover:bg-yellow-500 transition shadow-lg">
                            Buat Pesanan Baru
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-zinc-100">
                    <h4 class="text-xl font-bold text-zinc-900 mb-6">
                        Status Pesanan Terakhir
                    </h4>

                    @if ($pesananTerakhir)
                        <div class="border border-zinc-100 bg-white shadow-sm rounded-3xl p-1 relative overflow-hidden">
                            <div class="bg-zinc-50 rounded-[22px] p-6 sm:p-8 mb-1">
                                <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4">
                                    <div>
                                        <span
                                            class="inline-block px-3 py-1 rounded-full text-[10px] font-extrabold tracking-widest uppercase bg-white border border-zinc-200 text-zinc-500 mb-3 shadow-sm">
                                            Paket Layanan
                                        </span>
                                        <h5
                                            class="text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight leading-none">
                                            {{ $pesananTerakhir->paket->nama_paket ?? 'Paket Tidak Diketahui' }}
                                        </h5>
                                    </div>

                                    <div class="mt-2 sm:mt-0">
                                        <span
                                            class="px-5 py-2.5 rounded-2xl text-xs font-extrabold border inline-block shadow-sm
                                            {{ $pesananTerakhir->status_pemesanan == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                            {{ $pesananTerakhir->status_pemesanan == 'diproses' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                            {{ $pesananTerakhir->status_pemesanan == 'selesai' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                            {{ $pesananTerakhir->status_pemesanan == 'dibatalkan' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                            {{ strtoupper($pesananTerakhir->status_pemesanan) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pb-2">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">

                                    <div
                                        class="p-5 rounded-2xl bg-white border border-zinc-100 hover:border-zinc-300 transition">
                                        <p class="text-[11px] font-bold text-zinc-500 uppercase tracking-wider mb-1">
                                            Tanggal Pesan
                                        </p>
                                        <p class="text-sm font-extrabold text-zinc-900">
                                            {{ \Carbon\Carbon::parse($pesananTerakhir->tanggal_pesan)->format('d M Y') }}
                                        </p>
                                    </div>

                                    <div
                                        class="p-5 rounded-2xl bg-white border border-zinc-100 hover:border-zinc-300 transition">
                                        <p class="text-[11px] font-bold text-zinc-500 uppercase tracking-wider mb-1">
                                            Total Harga
                                        </p>
                                        <p class="text-sm font-extrabold text-zinc-900">
                                            Rp {{ number_format($pesananTerakhir->total_harga, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    @if ($pesananTerakhir->jadwal)
                                        <div
                                            class="sm:col-span-2 p-5 rounded-2xl bg-blue-50/50 border border-blue-100 hover:border-blue-200 transition mt-1">
                                            <p
                                                class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-1">
                                                Jadwal Produksi
                                            </p>
                                            <p class="text-sm font-extrabold text-blue-950">
                                                {{ \Carbon\Carbon::parse($pesananTerakhir->jadwal->tanggal_mulai)->format('d F Y') }}
                                                <span class="text-blue-400 mx-1">&rarr;</span>
                                                {{ \Carbon\Carbon::parse($pesananTerakhir->jadwal->tanggal_selesai)->format('d F Y') }}
                                            </p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12 border-2 border-dashed border-zinc-200 rounded-3xl bg-zinc-50">
                            <h5 class="text-xl font-bold text-zinc-900 mb-2 mt-4">Belum Ada Project Aktif</h5>
                            <p class="text-zinc-500 text-sm mb-6 max-w-xs mx-auto">
                                Anda belum melakukan pemesanan layanan apa pun di platform kami.
                            </p>
                            <a href="{{ route('booking.index') }}"
                                class="inline-block bg-zinc-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-zinc-800 transition shadow-lg mb-4">
                                Mulai Project Baru
                            </a>
                        </div>
                    @endif
                </div>

                <div
                    class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-zinc-100 flex flex-col justify-between">
                    <div>
                        <h4 class="font-bold text-zinc-900 text-xl mb-3 mt-2">Butuh Saran Paket?</h4>
                        <p class="text-sm text-zinc-500 mb-8 leading-relaxed">
                            Jika Anda bingung memilih layanan yang paling cocok untuk kebutuhan dokumentasi Anda,
                            gunakan fitur rekomendasi cerdas kami.
                        </p>
                    </div>
                    <a href="{{ route('rekomendasi.index') }}"
                        class="block text-center w-full bg-zinc-100 text-zinc-800 border border-zinc-200 py-3.5 rounded-2xl font-bold hover:bg-zinc-200 hover:text-zinc-950 transition shadow-sm">
                        Coba Fitur Rekomendasi
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
