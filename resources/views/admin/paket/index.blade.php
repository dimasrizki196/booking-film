<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Paket Layanan</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <a href="{{ route('admin.paket.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Paket</a>
            
            <table class="min-w-full border mt-4">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 border">Nama Paket</th>
                        <th class="px-4 py-2 border">Harga (Rp)</th>
                        <th class="px-4 py-2 border">Durasi (Hari)</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paket as $item)
                        <tr>
                            <td class="px-4 py-2 border">{{ $item->nama_paket }}</td>
                            <td class="px-4 py-2 border">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">{{ $item->durasi_pengerjaan }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('admin.paket.edit', $item->id) }}" class="text-blue-500 mr-2">Edit</a>
                                <form action="{{ route('admin.paket.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500" onclick="return confirm('Hapus paket ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>