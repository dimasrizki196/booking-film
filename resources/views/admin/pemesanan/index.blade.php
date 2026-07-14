<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Kelola Pemesanan dan Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 rounded-3xl shadow-xl border border-zinc-100">
                <!-- Pastikan action menggunakan route yang benar -->
                <form method="GET" action="{{ route('admin.pemesanan.index') }}" class="flex flex-col sm:flex-row gap-4">
                    <input type="text" name="search" placeholder="Cari nama pelanggan..."
                        value="{{ request('search') }}"
                        class="flex-1 rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49]">

                    <select name="status"
                        class="appearance-none rounded-2xl border-zinc-200 bg-zinc-50 py-3 px-4 focus:border-[#FCBF49] focus:ring-[#FCBF49]"
                        style="background-image: none;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses
                        </option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>

                    <button type="submit"
                        class="bg-zinc-900 text-white px-8 py-3 rounded-2xl font-bold hover:bg-zinc-800 transition shadow-md">
                        Cari
                    </button>

                    <a href="{{ route('admin.pemesanan.index') }}"
                        class="bg-zinc-100 text-zinc-600 px-6 py-3 rounded-2xl font-bold hover:bg-zinc-200 transition text-center">
                        Reset
                    </a>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Pesanan Masuk</h3>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Paket</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Tgl Pemesanan
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Jadwal
                                    Produksi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($pemesanan as $item)
                                <tr class="hover:bg-zinc-50 transition">
                                    <td class="px-6 py-5 font-bold text-zinc-900">
                                        {{ $item->user->name ?? 'User Terhapus' }}</td>
                                    <td class="px-6 py-5 font-bold text-zinc-700">
                                        {{ $item->paket->nama_paket ?? 'Paket Terhapus' }}</td>
                                    <td class="px-6 py-5 text-sm text-zinc-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-3 py-1 rounded-xl text-xs font-bold border
                    {{ $item->status_pemesanan == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                    {{ $item->status_pemesanan == 'diproses' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                    {{ $item->status_pemesanan == 'selesai' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                    {{ $item->status_pemesanan == 'dibatalkan' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                            {{ ucfirst($item->status_pemesanan) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-zinc-500">
                                        {{ $item->jadwal ? \Carbon\Carbon::parse($item->jadwal->tanggal_mulai)->format('d M Y') . ' s/d ' . \Carbon\Carbon::parse($item->jadwal->tanggal_selesai)->format('d M Y') : 'Belum Dijadwalkan' }}
                                    <td class="px-6 py-5 text-sm">
                                        @if ($item->status_pemesanan === 'selesai')
                                            <span class="text-zinc-400 text-xs font-bold italic">Tidak dapat
                                                diubah</span>
                                        @else
                                            <a href="{{ route('admin.pemesanan.edit', $item->id) }}"
                                                class="font-bold text-blue-600 hover:text-blue-800 mr-4">Kelola</a>
                                            <form action="{{ route('admin.pemesanan.destroy', $item->id) }}"
                                                method="POST" class="inline-block form-delete"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="font-bold text-red-500 hover:text-red-700">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-zinc-300 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>

                                        @if (request('search'))
                                            <p class="text-lg font-bold text-zinc-900">Nama "{{ request('search') }}"
                                                tidak tersedia.</p>
                                            <p class="text-sm text-zinc-500">Silakan periksa kembali ejaan atau gunakan
                                                kata kunci lain.</p>
                                            <a href="{{ route('admin.pemesanan.index') }}"
                                                class="mt-4 inline-block text-blue-600 font-bold hover:underline">Lihat
                                                Semua Pesanan</a>
                                        @else
                                            <p class="text-lg font-bold text-zinc-900">Belum ada pesanan masuk.</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('projectChart').getContext('2d');

        // Memberikan nilai default kosong jika $loadData tidak didefinisikan
        const labels = {!! isset($loadData) ? json_encode($loadData->pluck('date')) : '[]' !!};
        const dataPoints = {!! isset($loadData) ? json_encode($loadData->pluck('count')) : '[]' !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pesanan Masuk',
                    data: dataPoints,
                    borderColor: '#FCBF49',
                    backgroundColor: 'rgba(252, 191, 73, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
