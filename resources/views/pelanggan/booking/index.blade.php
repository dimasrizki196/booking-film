<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Booking Saya</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-700">Daftar Pesanan Anda</h3>
                <a href="{{ route('booking.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm transition">
                    + Buat Pesanan Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">ID Pesanan</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Paket</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Tanggal Request</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Status</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Jadwal Fix (Dari Admin)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($riwayat as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-800 font-bold">#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $item->paket->nama_paket ?? 'Paket Dihapus' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_pengerjaan)->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 rounded text-xs font-semibold 
                                        {{ $item->status_pemesanan == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $item->status_pemesanan == 'diproses' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $item->status_pemesanan == 'selesai' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $item->status_pemesanan == 'dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($item->status_pemesanan) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    @if($item->jadwal)
                                        <span class="text-green-600 font-medium">Mulai: {{ \Carbon\Carbon::parse($item->jadwal->tanggal_mulai)->format('d M Y') }}</span><br>
                                        <span class="text-xs text-gray-500">Lokasi: {{ $item->jadwal->lokasi_produksi }}</span>
                                    @else
                                        <span class="text-gray-400 italic">Menunggu konfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500 text-sm">Anda belum memiliki riwayat pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>