<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan mengambil pesanan yang statusnya 'selesai'
        $query = Pemesanan::with(['user', 'paket'])->where('status_pemesanan', 'selesai');

        // Jika admin mengisi rentang tanggal di form filter
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = $request->tanggal_akhir;
            $query->whereBetween('tanggal_pesan', [$tanggal_awal, $tanggal_akhir]);
        } else {
            // Default: Tampilkan data bulan ini
            $tanggal_awal = Carbon::now()->startOfMonth()->toDateString();
            $tanggal_akhir = Carbon::now()->endOfMonth()->toDateString();
            $query->whereBetween('tanggal_pesan', [$tanggal_awal, $tanggal_akhir]);
        }

        $laporan = $query->latest()->get();

        // Menghitung total statistik untuk summary card
        $totalPendapatan = $laporan->sum('total_harga');
        $totalPesanan = $laporan->count();

        return view('admin.laporan.index', compact('laporan', 'totalPendapatan', 'totalPesanan', 'tanggal_awal', 'tanggal_akhir'));
    }
}
