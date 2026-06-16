<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Riwayat Booking Saya') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Pesanan Anda</h3>

                    <a href="{{ route('booking.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-zinc-900 text-[#FCBF49] text-sm font-bold rounded-2xl hover:bg-zinc-800 transition-colors shadow-md focus:ring-2 focus:ring-[#FCBF49] focus:ring-offset-2 focus:outline-none">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Pesanan Baru
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center shadow-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-bold text-green-800">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    ID Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Paket</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Tanggal Request</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    Jadwal Fix (Dari Admin)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($riwayat as $item)
                                <tr class="hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-extrabold text-zinc-900">
                                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-zinc-700">
                                            {{ $item->paket->nama_paket ?? 'Paket Dihapus' }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-medium text-zinc-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pengerjaan)->format('d M Y') }}
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
                                        @if ($item->jadwal)
                                            <div class="text-sm font-bold text-green-600 mb-1">Mulai:
                                                {{ \Carbon\Carbon::parse($item->jadwal->tanggal_mulai)->format('d M Y') }}
                                            </div>
                                            <div class="text-xs font-medium text-zinc-500 flex items-center">
                                                <svg class="w-3.5 h-3.5 mr-1 text-zinc-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $item->jadwal->lokasi_produksi }}
                                            </div>
                                        @else
                                            <span class="inline-flex items-center text-sm text-zinc-400 italic">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Menunggu konfirmasi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 whitespace-nowrap text-center">
                                        <svg class="mx-auto h-12 w-12 text-zinc-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold text-zinc-500">Anda belum memiliki riwayat
                                            pesanan.</p>
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
