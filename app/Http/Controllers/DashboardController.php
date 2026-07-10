<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use Carbon\Carbon; // Pastikan Carbon di-import

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // ====================================================
            // 1. LOGIKA UNTUK TABEL DATA PROJECT (Tetap Sama)
            // ====================================================
            $pemesanan = null;

            if ($request->has('bulan') || $request->has('tahun')) {
                $query = Pemesanan::with(['user', 'paket', 'jadwal']);

                if ($request->filled('bulan')) {
                    $query->whereMonth('tanggal_pesan', $request->bulan);
                }
                if ($request->filled('tahun')) {
                    $query->whereYear('tanggal_pesan', $request->tahun);
                }

                $pemesanan = $query->latest('tanggal_pesan')->get();
            }

            // ====================================================
            // 2. OVERALL JUMLAH STATUS PROJECT (BARU)
            // ====================================================
            $overall = [
                'total' => Pemesanan::count(),
                'pending' => Pemesanan::where('status_pemesanan', 'pending')->count(),
                'diproses' => Pemesanan::where('status_pemesanan', 'diproses')->count(),
                'selesai' => Pemesanan::where('status_pemesanan', 'selesai')->count(),
                'dibatalkan' => Pemesanan::where('status_pemesanan', 'dibatalkan')->count(),
            ];

            // ====================================================
            // 3. LOGIKA UNTUK CHART PER BULAN (Tetap Sama)
            // ====================================================
            $chartYear = $request->input('chart_tahun', date('Y'));
            $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            $dataPending = [];
            $dataDiproses = [];
            $dataSelesai = [];

            foreach ($months as $m) {
                $dataPending[] = Pemesanan::whereYear('tanggal_pesan', $chartYear)
                    ->whereMonth('tanggal_pesan', $m)->where('status_pemesanan', 'pending')->count();
                $dataDiproses[] = Pemesanan::whereYear('tanggal_pesan', $chartYear)
                    ->whereMonth('tanggal_pesan', $m)->where('status_pemesanan', 'diproses')->count();
                $dataSelesai[] = Pemesanan::whereYear('tanggal_pesan', $chartYear)
                    ->whereMonth('tanggal_pesan', $m)->where('status_pemesanan', 'selesai')->count();
            }

            // ====================================================
            // 4. VISUALISASI LOAD PROJECT PER TANGGAL (BARU)
            // Mengambil data pesanan harian untuk 30 hari terakhir
            // ====================================================
            $loadTanggal = [];
            $loadTotal = [];

            $startDate = Carbon::now()->subDays(29);
            for ($i = 0; $i < 30; $i++) {
                $date = $startDate->copy()->addDays($i);
                $loadTanggal[] = $date->format('d M'); // Format: 01 Jul

                // Menghitung jumlah pesanan masuk pada tanggal tersebut
                $loadTotal[] = Pemesanan::whereDate('tanggal_pesan', $date->format('Y-m-d'))->count();
            }

            return view('dashboard', compact(
                'pemesanan',
                'overall',
                'dataPending',
                'dataDiproses',
                'dataSelesai',
                'chartYear',
                'loadTanggal',
                'loadTotal'
            ));
        }

        // ====================================================
        // LOGIKA PELANGGAN
        // ====================================================
        $pesananTerakhir = Pemesanan::with(['paket', 'jadwal'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return view('pelanggan.dashboard', compact('pesananTerakhir'));
    }
}
