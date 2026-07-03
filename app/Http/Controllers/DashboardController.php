<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 1. LOGIKA UNTUK TABEL DATA PROJECT
            $pemesanan = null;

            // Tabel hanya akan diproses dan muncul jika parameter pencarian dikirim (walaupun memilih "Semua")
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

            // 2. LOGIKA UNTUK CHART (MEMILIKI FILTER TAHUN SENDIRI)
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

            return view('dashboard', compact(
                'pemesanan',
                'dataPending',
                'dataDiproses',
                'dataSelesai',
                'chartYear'
            ));
        }

        // Logika Pelanggan
        $pesananTerakhir = Pemesanan::with(['paket', 'jadwal'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return view('pelanggan.dashboard', compact('pesananTerakhir'));
    }
}
