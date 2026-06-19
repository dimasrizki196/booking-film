<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan; // Pastikan model ini dipanggil

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. LOGIKA UNTUK ADMIN
        if ($user->role === 'admin') {
            $query = Pemesanan::with(['user', 'paket', 'jadwal']);

            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal_pesan', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $query->whereYear('tanggal_pesan', $request->tahun);
            }

            $pemesanan = $query->latest('tanggal_pesan')->get();
            return view('dashboard', compact('pemesanan'));
        }

        // 2. LOGIKA UNTUK PELANGGAN
        // Ambil 1 pesanan terakhir milik user yang sedang login
        $pesananTerakhir = Pemesanan::with(['paket', 'jadwal'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Kirim variabel $pesananTerakhir ke view pelanggan
        return view('pelanggan.dashboard', compact('pesananTerakhir'));
    }
}
