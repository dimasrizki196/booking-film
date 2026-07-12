<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Laporan Pemesanan & Project') }}
        </h2>
    </x-slot>

    @php
        $bulans = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $currentYear = date('Y');
    @endphp

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-zinc-100">
                <div
                    class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-6 pb-6 border-b border-zinc-100">
                    <div>
                        <h4 class="text-lg font-bold text-zinc-900">Filter & Ekspor Laporan</h4>
                        <p class="text-sm text-zinc-500">Gunakan filter untuk menyaring data, lalu unduh laporan dalam
                            format Excel atau PDF.</p>
                    </div>

                    <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                        <a href="{{ route('admin.laporan.excel', request()->all()) }}"
                            class="flex-1 lg:flex-none inline-flex justify-center items-center px-5 py-3 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 transition shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Unduh Excel
                        </a>

                        <a href="{{ route('admin.laporan.pdf', request()->all()) }}"
                            class="flex-1 lg:flex-none inline-flex justify-center items-center px-5 py-3 bg-rose-600 text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Unduh PDF
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('admin.laporan.index') }}"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Bulan</label>
                        <select name="bulan"
                            class="w-full appearance-none rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 text-sm font-medium text-zinc-700 focus:border-[#FCBF49] focus:ring-[#FCBF49]">
                            <option value="">Semua Bulan</option>
                            @foreach ($bulans as $num => $name)
                                <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Tahun</label>
                        <select name="tahun"
                            class="w-full appearance-none rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 text-sm font-medium text-zinc-700 focus:border-[#FCBF49] focus:ring-[#FCBF49]">
                            <option value="">Semua Tahun</option>
                            @for ($i = $currentYear; $i >= $currentYear - 5; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                    Tahun {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Status
                            Pesanan</label>
                        <select name="status"
                            class="w-full appearance-none rounded-xl border-zinc-200 bg-zinc-50 py-3 px-4 text-sm font-medium text-zinc-700 focus:border-[#FCBF49] focus:ring-[#FCBF49]">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                                Dibatalkan</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-zinc-900 text-white py-3 px-6 rounded-xl font-bold text-sm hover:bg-zinc-800 transition shadow-sm">
                            Terapkan
                        </button>
                        @if (request()->has('bulan') || request()->has('tahun') || request()->has('status'))
                            <a href="{{ route('admin.laporan.index') }}"
                                class="bg-zinc-100 text-zinc-700 py-3 px-4 rounded-xl font-bold text-sm hover:bg-zinc-200 transition text-center shadow-sm">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Data Ringkasan Laporan</h3>
                        <p class="text-sm text-zinc-500 mt-1">
                            Menampilkan <span class="font-bold text-zinc-900">{{ $laporan->count() }}</span> data
                            project yang sesuai kriteria.
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    ID Pesanan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Pelanggan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Paket Film</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Tgl Transaksi</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Total Nilai</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($laporan as $item)
                                <tr class="hover:bg-zinc-50 transition-colors duration-150">
                                    <td class="px-6 py-4 font-extrabold text-zinc-900 text-sm">
                                        #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-zinc-800 text-sm">
                                        {{ $item->user->name ?? 'Klien Terhapus' }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-zinc-600 text-sm">
                                        {{ $item->paket->nama_paket ?? 'Paket Terhapus' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-extrabold text-zinc-900 text-sm">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1.5 rounded-xl text-xs font-bold border
                                            {{ $item->status_pemesanan == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                            {{ $item->status_pemesanan == 'diproses' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                            {{ $item->status_pemesanan == 'selesai' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                            {{ $item->status_pemesanan == 'dibatalkan' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                            {{ ucfirst($item->status_pemesanan) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-zinc-400 mb-2">
                                            <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-base font-bold text-zinc-900">Data Laporan Kosong</p>
                                        <p class="text-xs text-zinc-500 max-w-sm mx-auto mt-1">
                                            Tidak ada project atau pemesanan yang masuk pada kombinasi filter yang Anda
                                            pilih saat ini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
