<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <h2 class="text-3xl text-zinc-900 leading-tight tracking-tight"
            style="font-family: 'Playfair Display', serif; font-weight: 800;">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    @php
        $bulans = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $currentYear = date('Y');
    @endphp

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="w-full bg-gradient-to-br from-zinc-900 to-zinc-800 p-8 rounded-3xl shadow-xl border border-zinc-700 relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-[#FCBF49] rounded-full opacity-20 blur-3xl"></div>
                <div class="absolute bottom-0 right-10 w-32 h-32 bg-blue-500 rounded-full opacity-20 blur-2xl"></div>

                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-white mb-3" style="font-family: 'Playfair Display', serif;">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-zinc-300 text-lg mb-8 max-w-xl">
                        Pantau dan kelola seluruh aktivitas pemesanan, jadwal produksi, serta laporan sistem aplikasi
                        NextProjectFilm.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.pemesanan.index') }}"
                            class="bg-[#FCBF49] text-zinc-950 px-6 py-3 rounded-xl font-bold hover:bg-yellow-500 transition shadow-lg flex items-center gap-2">
                            Kelola Detail Pemesanan
                        </a>
                        <a href="{{ route('admin.laporan.index') }}"
                            class="bg-white/10 text-white border border-white/20 px-6 py-3 rounded-xl font-bold hover:bg-white/20 transition shadow-lg backdrop-blur-sm flex items-center gap-2">
                            Lihat Laporan Lengkap
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-3xl shadow-md border border-zinc-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-zinc-900">Filter Data Dashboard</h3>
                    <p class="text-sm text-zinc-500">Terapkan filter ini untuk menyesuaikan seluruh kartu, tabel, dan
                        grafik.</p>
                </div>

                <form method="GET" action="{{ route('dashboard') }}"
                    class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <select name="bulan"
                        class="appearance-none rounded-xl border-zinc-200 bg-zinc-50 py-2.5 px-4 text-sm font-medium text-zinc-700 focus:border-[#FCBF49] focus:ring-[#FCBF49]">
                        <option value="">Semua Bulan</option>
                        @foreach ($bulans as $num => $name)
                            <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                                {{ $name }}</option>
                        @endforeach
                    </select>

                    <select name="tahun"
                        class="appearance-none rounded-xl border-zinc-200 bg-zinc-50 py-2.5 px-4 text-sm font-medium text-zinc-700 focus:border-[#FCBF49] focus:ring-[#FCBF49]">
                        <option value="">Semua Tahun</option>
                        @for ($i = $currentYear; $i >= $currentYear - 5; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="bg-zinc-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-zinc-800 transition shadow-sm">
                            Terapkan
                        </button>
                        @if (request()->has('bulan') || request()->has('tahun'))
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center justify-center bg-red-50 text-red-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-red-100 transition shadow-sm border border-red-100">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-3xl shadow-md border border-zinc-100 flex flex-col justify-between">
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total Pending</span>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-zinc-900">{{ $countPending ?? 0 }}</span>
                        <span
                            class="text-xs font-bold px-2 py-0.5 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-lg">Pesanan</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-3xl shadow-md border border-zinc-100 flex flex-col justify-between">
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total Diproses</span>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-zinc-900">{{ $countDiproses ?? 0 }}</span>
                        <span
                            class="text-xs font-bold px-2 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg">Produksi</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-3xl shadow-md border border-zinc-100 flex flex-col justify-between">
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total Selesai</span>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-zinc-900">{{ $countSelesai ?? 0 }}</span>
                        <span
                            class="text-xs font-bold px-2 py-0.5 bg-green-50 text-green-700 border border-green-200 rounded-lg">Tuntas</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-3xl shadow-md border border-zinc-100 flex flex-col justify-between">
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total Dibatalkan</span>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-black text-zinc-900">{{ $countDibatalkan ?? 0 }}</span>
                        <span
                            class="text-xs font-bold px-2 py-0.5 bg-red-50 text-red-700 border border-red-200 rounded-lg">Batal</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-zinc-100 p-6 sm:p-8">

                <div class="mb-6">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Daftar Pesanan Project</h3>
                    <p class="text-sm text-zinc-500 mt-1">
                        Menampilkan <span class="font-bold text-zinc-900">{{ $pemesanan->total() }}</span> pesanan
                        @if (request('bulan') || request('tahun'))
                            berdasarkan filter yang dipilih.
                        @else
                            secara keseluruhan.
                        @endif
                    </p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-zinc-200 mb-4">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Paket</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Tgl Pesan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($pemesanan as $item)
                                <tr class="hover:bg-zinc-50 transition">
                                    <td class="px-6 py-4 font-bold text-zinc-900">
                                        {{ $item->user->name ?? 'User Terhapus' }}</td>
                                    <td class="px-6 py-4 font-bold text-zinc-700">
                                        {{ $item->paket->nama_paket ?? 'Paket Terhapus' }}</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-xl text-xs font-bold border
                                            {{ $item->status_pemesanan == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                            {{ $item->status_pemesanan == 'diproses' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                            {{ $item->status_pemesanan == 'selesai' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                            {{ $item->status_pemesanan == 'dibatalkan' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                            {{ ucfirst($item->status_pemesanan) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-lg font-bold text-zinc-900">Belum Ada Pesanan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $pemesanan->links() }}
                </div>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-zinc-100">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-zinc-900 tracking-tight">Timeline Pengerjaan Project</h3>
                    <p class="text-sm text-zinc-500">
                        Visualisasi lama waktu produksi di bulan <span
                            class="font-bold text-zinc-900">{{ $bulans[$ganttBulan] }} {{ $ganttTahun }}</span>.
                    </p>
                </div>

                <div class="relative h-[400px] w-full">
                    <canvas id="loadProjectChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxLoad = document.getElementById('loadProjectChart').getContext('2d');
            const tooltipsData = @json($ganttTooltips ?? []);

            new Chart(ctxLoad, {
                type: 'bar',
                data: {
                    labels: @json($ganttLabels ?? []),
                    datasets: [{
                        label: 'Durasi Produksi',
                        data: @json($ganttData ?? []),
                        backgroundColor: 'rgba(252, 191, 73, 0.8)',
                        borderColor: '#FCBF49',
                        borderWidth: 1,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    indexAxis: 'y', // Ubah menjadi chart horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            min: 1,
                            max: {{ $daysInMonth ?? 31 }},
                            ticks: {
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Tanggal',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jadwal: ' + tooltipsData[context.dataIndex];
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
