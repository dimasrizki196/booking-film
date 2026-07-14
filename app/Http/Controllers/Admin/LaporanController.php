<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanPemesananExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    private function getFilteredData(Request $request)
    {
        $query = Pemesanan::with(['user', 'paket', 'jadwal']);

        // 1. Filter Bulan (Menggunakan 'filled' agar nilai kosong "" / Semua Bulan diabaikan)
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_pesan', $request->bulan);
        }

        // 2. Filter Tahun (Menggunakan 'filled' agar nilai kosong "" / Semua Tahun diabaikan)
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_pesan', $request->tahun);
        }

        // 3. Filter Status (Abaikan jika kosong atau bernilai 'semua')
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_pemesanan', $request->status);
        }

        // Urutkan dari transaksi yang paling baru
        return $query->latest('tanggal_pesan')->get();
    }

    public function index(Request $request)
    {
        // Ambil data yang sudah difilter secara presisi
        $laporan = $this->getFilteredData($request);

        // Hitung total pendapatan HANYA dari pesanan yang selesai
        $totalPendapatan = $laporan->where('status_pemesanan', 'selesai')->sum('total_harga');
        $totalPesanan = $laporan->count();

        // Kembalikan parameter ke view agar form filter tetap mempertahankan pilihan user
        $bulan = $request->input('bulan', '');
        $tahun = $request->input('tahun', '');
        $status = $request->input('status', '');

        return view('admin.laporan.index', compact(
            'laporan',
            'totalPendapatan',
            'totalPesanan',
            'bulan',
            'tahun',
            'status'
        ));
    }

    public function exportPdf(Request $request)
    {
        $laporan = $this->getFilteredData($request);

        // Mengambil filter untuk ditampilkan di PDF agar admin tahu data apa yang dicetak
        $filterBulan = $request->bulan ? Carbon::create()->month($request->bulan)->format('F') : 'Semua';
        $filterTahun = $request->tahun ?? 'Semua';
        $filterStatus = $request->status ? ucfirst($request->status) : 'Semua';

        $html = '
        <html>
        <head>
            <style>
                body { font-family: "Helvetica", sans-serif; color: #333; }
                .header { text-align: center; margin-bottom: 20px; }
                .info { margin-bottom: 20px; font-size: 13px; }
                table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                th { background-color: #27272a; color: white; padding: 10px; text-align: left; font-size: 12px; }
                td { border: 1px solid #e5e7eb; padding: 8px; font-size: 11px; }
                .text-right { text-align: right; }
                .total-row { background-color: #f9fafb; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1 style="margin-bottom: 5px;">NextProjectFilm</h1>
                <h3 style="margin-top: 0;">Laporan Pesanan & Project</h3>
            </div>

            <div class="info">
                <strong>Informasi Filter:</strong><br>
                Bulan: ' . $filterBulan . ' | Tahun: ' . $filterTahun . ' | Status: ' . $filterStatus . '<br>
                Dicetak pada: ' . date('d M Y H:i') . '
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Tgl Pesan</th>
                        <th>Status</th>
                        <th class="text-right">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody>';

        $totalKeseluruhan = 0;
        foreach ($laporan as $item) {
            $totalKeseluruhan += $item->total_harga;
            $html .= '<tr>
                <td>' . ($item->user->name ?? '-') . '</td>
                <td>' . ($item->paket->nama_paket ?? '-') . '</td>
                <td>' . Carbon::parse($item->tanggal_pesan)->format('d M Y') . '</td>
                <td>' . ucfirst($item->status_pemesanan) . '</td>
                <td class="text-right">Rp ' . number_format($item->total_harga, 0, ',', '.') . '</td>
            </tr>';
        }

        $html .= '
                <tr class="total-row">
                    <td colspan="4" class="text-right">Total Pendapatan</td>
                    <td class="text-right">Rp ' . number_format($totalKeseluruhan, 0, ',', '.') . '</td>
                </tr>
                </tbody>
            </table>
        </body>
        </html>';

        $pdf = Pdf::loadHtml($html);
        // Mengatur orientasi menjadi landscape agar kolom tidak berhimpitan
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('Laporan_NextProjectFilm_' . date('Ymd-His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $laporan = $this->getFilteredData($request);

        // Memanggil class Export yang meneruskan collection hasil filter
        return Excel::download(new LaporanPemesananExport($laporan), 'laporan-pesanan-' . date('Ymd-His') . '.xlsx');
    }
}
