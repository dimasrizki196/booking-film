<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kelola Paket Layanan') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Paket Layanan</h3>
                    </div>

                    <a href="{{ route('admin.paket.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-zinc-900 text-[#FCBF49] text-sm font-bold rounded-2xl hover:bg-zinc-800 transition-colors shadow-md focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 focus:outline-none">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Paket
                    </a>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Nama Paket</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Harga</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Durasi</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($paket as $item)
                                <tr class="hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-zinc-900">{{ $item->nama_paket }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-[#FCBF49]">
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">
                                            {{ $item->durasi_pengerjaan }} Hari
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.paket.edit', $item->id) }}"
                                            class="font-bold text-[#FCBF49] hover:text-yellow-600 transition-colors mr-4">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.paket.destroy', $item->id) }}" method="POST"
                                            class="inline-block form-delete"
                                            data-confirm-message="Paket layanan '{{ $item->nama_paket }}' akan dihapus dan tidak dapat dikembalikan.">
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
                                    <td colspan="4" class="px-6 py-12 whitespace-nowrap text-center">
                                        <svg class="mx-auto h-12 w-12 text-zinc-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold text-zinc-500">Belum ada paket layanan yang
                                            ditambahkan.</p>
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
