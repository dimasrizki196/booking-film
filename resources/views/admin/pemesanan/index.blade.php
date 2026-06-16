<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pemesanan & Jadwal</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Pelanggan</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Paket</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Tgl Pemesanan</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Status</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Jadwal Produksi</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($pemesanan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-800 font-medium">{{ $item->user->name ?? 'User Terhapus' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item->paket->nama_paket ?? 'Paket Terhapus' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}</td>
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
                                        {{ \Carbon\Carbon::parse($item->jadwal->tanggal_mulai)->format('d M Y') }} s/d <br>
                                        {{ \Carbon\Carbon::parse($item->jadwal->tanggal_selesai)->format('d M Y') }}
                                    @else
                                        <span class="text-gray-400 italic">Belum dijadwalkan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('admin.pemesanan.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Kelola</a>
                                    <form action="{{ route('admin.pemesanan.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500 text-sm">Belum ada pesanan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>