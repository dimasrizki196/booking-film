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
            // 1. DIBUAT BASE QUERY KHUSUS UNTUK MENGHITUNG KARTU STATUS
            // Ini agar filter bulan & tahun juga otomatis memengaruhi jumlah di kartu
            $countQuery = Pemesanan::query();

            // 2. LOGIKA UNTUK TABEL DATA PROJECT
            $query = Pemesanan::with(['user', 'paket', 'jadwal']);

            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal_pesan', $request->bulan);
                $countQuery->whereMonth('tanggal_pesan', $request->bulan); // Ikut filter kartu
            }
            if ($request->filled('tahun')) {
                $query->whereYear('tanggal_pesan', $request->tahun);
                $countQuery->whereYear('tanggal_pesan', $request->tahun); // Ikut filter kartu
            }

            $pemesanan = $query->latest('tanggal_pesan')->get();

            // 3. HITUNG JUMLAH STATUS SECARA AKURAT MENGGUNAKAN CLONE QUERY
            // Menggunakan clone agar kondisi where status tidak saling bertabrakan
            $countPending = (clone $countQuery)->where('status_pemesanan', 'pending')->count();
            $countDiproses = (clone $countQuery)->where('status_pemesanan', 'diproses')->count();
            $countSelesai = (clone $countQuery)->where('status_pemesanan', 'selesai')->count();
            $countDibatalkan = (clone $countQuery)->where('status_pemesanan', 'dibatalkan')->count();


            // 4. LOGIKA UNTUK FILTER CHART BULANAN (TETAP SEPERTI SEBELUMNYA)
            $chartYear = $request->input('chart_tahun', date('Y'));
            $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            $dataPending = [];
            $dataDiproses = [];
            $dataSelesai = [];

            foreach ($months as $m) {
                $dataPending[] = Pemesanan::whereYear('tanggal_pesan', $chartYear)->whereMonth('tanggal_pesan', $m)->where('status_pemesanan', 'pending')->count();
                $dataDiproses[] = Pemesanan::whereYear('tanggal_pesan', $chartYear)->whereMonth('tanggal_pesan', $m)->where('status_pemesanan', 'diproses')->count();
                $dataSelesai[] = Pemesanan::whereYear('tanggal_pesan', $chartYear)->whereMonth('tanggal_pesan', $m)->where('status_pemesanan', 'selesai')->count();
            }

            // 5. LOGIKA LOAD PROJECT PER TANGGAL (CONTOH DATA TERDEKAT)
            // Ambil data project berjalan 7 hari ke depan untuk grafik garis load
            $upcomingProjects = Pemesanan::where('status_pemesanan', 'diproses')
                ->where('tanggal_pengerjaan', '>=', now()->toDateString())
                ->orderBy('tanggal_pengerjaan', 'asc')
                ->take(7)
                ->get()
                ->groupBy('tanggal_pengerjaan');

            $loadLabels = [];
            $loadValues = [];
            foreach ($upcomingProjects as $date => $projects) {
                $loadLabels[] = \Carbon\Carbon::parse($date)->format('d M');
                $loadValues[] = $projects->count();
            }

            return view('dashboard', compact(
                'pemesanan',
                'chartYear',
                'dataPending',
                'dataDiproses',
                'dataSelesai',
                'countPending',
                'countDiproses',
                'countSelesai',
                'countDibatalkan',
                'loadLabels',
                'loadValues'
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
