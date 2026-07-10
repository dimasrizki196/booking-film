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
     * Method bantuan (Helper) agar logika filter tidak ditulis berulang
     * di index, exportPdf, dan exportExcel.
     */
    private function getFilteredData(Request $request)
    {
        $query = Pemesanan::with(['user', 'paket']);

        // 1. Filter Rentang Tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_pesan', [$request->tanggal_awal, $request->tanggal_akhir]);
        } else {
            // Default: Tampilkan data bulan ini
            $tanggal_awal = Carbon::now()->startOfMonth()->toDateString();
            $tanggal_akhir = Carbon::now()->endOfMonth()->toDateString();
            $query->whereBetween('tanggal_pesan', [$tanggal_awal, $tanggal_akhir]);
        }

        // 2. Filter Status (Menyesuaikan revisi)
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_pemesanan', $request->status);
        }

        return $query->latest()->get();
    }

    public function index(Request $request)
    {
        // Ambil data yang sudah difilter
        $laporan = $this->getFilteredData($request);

        // Hitung total pendapatan HANYA dari pesanan yang selesai
        $totalPendapatan = $laporan->where('status_pemesanan', 'selesai')->sum('total_harga');
        $totalPesanan = $laporan->count();

        // Kembalikan parameter ke view agar form filter tetap menampilkan data yang dipilih
        $tanggal_awal = $request->tanggal_awal ?? Carbon::now()->startOfMonth()->toDateString();
        $tanggal_akhir = $request->tanggal_akhir ?? Carbon::now()->endOfMonth()->toDateString();
        $status = $request->status ?? 'semua';

        return view('admin.laporan.index', compact('laporan', 'totalPendapatan', 'totalPesanan', 'tanggal_awal', 'tanggal_akhir', 'status'));
    }

    public function exportPdf(Request $request)
    {
        $laporan = $this->getFilteredData($request);

        // Memuat view khusus untuk desain PDF
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));

        return $pdf->download('laporan-pesanan-' . date('Ymd') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $laporan = $this->getFilteredData($request);

        // Memanggil class Export yang sudah kita buat sebelumnya
        return Excel::download(new LaporanPemesananExport($laporan), 'laporan-pesanan-' . date('Ymd') . '.xlsx');
    }
}
