<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Portofolio Film</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-700">Daftar Karya Film</h3>
                <a href="{{ route('admin.portofolio.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition">
                    + Tambah Portofolio
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Thumbnail</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Judul Film</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Tanggal Upload
                            </th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Link Video</th>
                            <th class="px-4 py-3 border-b text-left text-sm font-medium text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($portofolio as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    @if ($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail"
                                            class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400 text-xs italic">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-800 font-medium">{{ $item->judul_film }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ $item->link_video }}" target="_blank"
                                        class="text-blue-500 hover:underline">Tonton Video</a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('admin.portofolio.edit', $item->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('admin.portofolio.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Yakin ingin menghapus portofolio ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500 text-sm">Belum ada data
                                    portofolio.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
