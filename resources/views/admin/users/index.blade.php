<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-zinc-900 leading-tight tracking-tight">
            {{ __('Kelola Data Pelanggan') }}
        </h2>
    </x-slot>

<div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Pelanggan</h3>
                        <p class="text-sm font-medium text-zinc-500 mt-1">Manajemen data pengguna Next Project Film.</p>
                    </div>

                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-zinc-900 text-[#FCBF49] text-sm font-bold rounded-2xl hover:bg-zinc-800 transition-colors shadow-md focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 focus:outline-none">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Pelanggan
                    </a>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Tanggal Daftar
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($pelanggan as $index => $user)
                                <tr class="hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-zinc-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-zinc-900">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">
                                            {{ $user->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="font-bold text-[#FCBF49] hover:text-yellow-600 transition-colors mr-4">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus data pelanggan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-bold text-red-500 hover:text-red-700 transition-colors">
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
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold text-zinc-500">Belum ada data pelanggan yang terdaftar.</p>
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
