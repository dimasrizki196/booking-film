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
    /**
     * Method bantuan (Helper) agar logika filter akurat dan konsisten
     * antara tampilan tabel di index, exportPdf, dan exportExcel.
     */
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

        // Memuat view khusus untuk desain PDF
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));

        return $pdf->download('laporan-pesanan-' . date('Ymd-His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $laporan = $this->getFilteredData($request);

        // Memanggil class Export yang meneruskan collection hasil filter
        return Excel::download(new LaporanPemesananExport($laporan), 'laporan-pesanan-' . date('Ymd-His') . '.xlsx');
    }
}
    