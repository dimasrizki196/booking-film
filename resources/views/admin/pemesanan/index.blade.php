<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kelola Pemesanan dan Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Pesanan Masuk</h3>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Pelanggan</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Paket</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Tgl Pemesanan</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Jadwal Produksi</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($pemesanan as $item)
                                <tr class="hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-zinc-900">
                                            {{ $item->user->name ?? 'User Terhapus' }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-zinc-700">
                                            {{ $item->paket->nama_paket ?? 'Paket Terhapus' }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1.5 rounded-xl text-xs font-bold border
                                            {{ $item->status_pemesanan == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                            {{ $item->status_pemesanan == 'diproses' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                            {{ $item->status_pemesanan == 'selesai' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                            {{ $item->status_pemesanan == 'dibatalkan' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                            {{ ucfirst($item->status_pemesanan) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">
                                            @if ($item->jadwal)
                                                <span
                                                    class="text-zinc-800 font-bold">{{ \Carbon\Carbon::parse($item->jadwal->tanggal_mulai)->format('d M Y') }}</span>
                                                <span class="mx-1 text-zinc-400">s/d</span>
                                                <span
                                                    class="text-zinc-800 font-bold">{{ \Carbon\Carbon::parse($item->jadwal->tanggal_selesai)->format('d M Y') }}</span>
                                            @else
                                                <span class="inline-flex items-center text-zinc-400 italic">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Belum dijadwalkan
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.pemesanan.edit', $item->id) }}"
                                            class="font-bold text-[#FCBF49] hover:text-yellow-600 transition-colors mr-4">
                                            Kelola
                                        </a>

                                        <form action="{{ route('admin.pemesanan.destroy', $item->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
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
                                    <td colspan="6" class="px-6 py-12 whitespace-nowrap text-center">
                                        <svg class="mx-auto h-12 w-12 text-zinc-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold text-zinc-500">Belum ada pesanan masuk.</p>
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
