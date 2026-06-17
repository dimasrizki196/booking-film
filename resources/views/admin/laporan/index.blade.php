<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Berkala</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-6 border border-gray-200">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal', $tanggal_awal) }}" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir', $tanggal_akhir) }}" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>
                <div class="w-full md:w-1/3 flex gap-2">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded transition w-full">
                        Filter Data
                    </button>
                    <a href="{{ route('admin.laporan.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition text-center flex-shrink-0">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-indigo-50 border border-indigo-100 p-6 rounded-lg shadow-sm">
                <h3 class="text-indigo-800 font-bold text-lg mb-1">Total Pendapatan</h3>
                <p class="text-3xl font-black text-indigo-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                <p class="text-sm text-indigo-600 mt-2">Berdasarkan pesanan selesai pada rentang tanggal yang dipilih.</p>
            </div>
            <div class="bg-green-50 border border-green-100 p-6 rounded-lg shadow-sm">
                <h3 class="text-green-800 font-bold text-lg mb-1">Total Pesanan Selesai</h3>
                <p class="text-3xl font-black text-green-900">{{ $totalPesanan }} Transaksi</p>
                <p class="text-sm text-green-600 mt-2">Telah dieksekusi oleh tim produksi.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">ID Pesanan</th>
                                <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Pelanggan</th>
                                <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Paket Layanan</th>
                                <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Tgl Pesan</th>
                                <th class="px-4 py-3 border-b text-right text-sm font-medium text-gray-600">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($laporan as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-800 font-bold">#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-800">{{ $item->user->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->paket->nama_paket ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-800 font-medium text-right">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500 text-sm">Tidak ada data pesanan selesai pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>