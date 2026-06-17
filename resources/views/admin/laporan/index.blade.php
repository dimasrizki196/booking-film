<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight" style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Laporan Berkala') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-zinc-100 mb-8">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal', $tanggal_awal) }}"
                        onclick="this.showPicker()"
                        class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium cursor-pointer" required>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir', $tanggal_akhir) }}"
                        onclick="this.showPicker()"
                        class="w-full rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49] transition duration-200 text-zinc-800 font-medium cursor-pointer" required>
                </div>
                <div class="w-full md:w-1/3 flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                        class="w-full sm:flex-1 inline-flex justify-center items-center px-6 py-3 bg-zinc-900 border border-transparent rounded-xl font-extrabold text-sm text-[#FCBF49] tracking-widest hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        FILTER DATA
                    </button>
                    <a href="{{ route('admin.laporan.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-zinc-100 border border-transparent rounded-xl font-extrabold text-sm text-zinc-800 tracking-widest hover:bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm text-center">
                        RESET
                    </a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-zinc-900 border border-zinc-800 p-6 sm:p-8 rounded-3xl shadow-lg relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#FCBF49] rounded-full opacity-10 blur-3xl group-hover:opacity-20 transition-opacity duration-500"></div>
                <h3 class="text-zinc-400 font-bold text-sm uppercase tracking-wider mb-2">Total Pendapatan</h3>
                <p class="text-4xl font-black text-[#FCBF49] tracking-tight">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                <p class="text-sm text-zinc-500 mt-3 font-medium">Berdasarkan pesanan selesai pada rentang tanggal terpilih.</p>
            </div>

            <div class="bg-white border border-zinc-200 p-6 sm:p-8 rounded-3xl shadow-sm relative overflow-hidden">
                <h3 class="text-zinc-500 font-bold text-sm uppercase tracking-wider mb-2">Total Pesanan Selesai</h3>
                <p class="text-4xl font-black text-zinc-900 tracking-tight">{{ $totalPesanan }} <span class="text-xl text-zinc-400 font-bold">Transaksi</span></p>
                <p class="text-sm text-zinc-500 mt-3 font-medium">Telah dieksekusi dan diselesaikan oleh tim produksi.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Rincian Transaksi</h3>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                <table class="min-w-full divide-y divide-zinc-200">
                    <thead class="bg-zinc-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">ID Pesanan</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Pelanggan</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Paket Layanan</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Tgl Pesan</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-zinc-500 uppercase tracking-wider">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-zinc-100">
                        @forelse ($laporan as $item)
                            <tr class="hover:bg-zinc-50 transition-colors duration-200">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-extrabold text-zinc-900">
                                    #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-zinc-700">
                                    {{ $item->user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-zinc-500">
                                    {{ $item->paket->nama_paket ?? '-' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-zinc-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-[#FCBF49] text-right">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-zinc-500 text-sm font-medium">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-zinc-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Tidak ada data pesanan selesai pada periode ini.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
