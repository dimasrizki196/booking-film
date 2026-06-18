<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kelola Portofolio Film') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Karya Film</h3>
                    </div>

                    <a href="{{ route('admin.portofolio.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-zinc-900 text-[#FCBF49] text-sm font-bold rounded-2xl hover:bg-zinc-800 transition-colors shadow-md focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 focus:outline-none">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Portofolio
                    </a>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Thumbnail</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Judul Film</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Tanggal Upload</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Link Video</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($portofolio as $item)
                                <tr class="hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        @if ($item->thumbnail)
                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail"
                                                class="w-16 h-16 object-cover rounded-xl shadow-sm border border-zinc-200">
                                        @else
                                            <div
                                                class="w-16 h-16 bg-zinc-100 rounded-xl flex items-center justify-center border border-zinc-200">
                                                <span class="text-zinc-400 text-[10px] font-bold uppercase">No
                                                    Image</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-zinc-900">{{ $item->judul_film }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <a href="{{ $item->link_video }}" target="_blank"
                                            class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                            Tonton Video
                                        </a>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.portofolio.edit', $item->id) }}"
                                            class="font-bold text-blue-600 hover:text-blue-800 transition-colors mr-4">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.portofolio.destroy', $item->id) }}" method="POST"
                                            class="inline-block form-delete"
                                            data-confirm-message="Karya film '{{ $item->judul_film }}' akan dihapus secara permanen.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-bold text-red-500 hover:text-red-700 transition-colors focus:outline-none">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 whitespace-nowrap text-center">
                                        <svg class="mx-auto h-12 w-12 text-zinc-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold text-zinc-500">Belum ada data portofolio.</p>
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
