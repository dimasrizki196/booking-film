<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    // Menampilkan halaman form kalkulator
    public function index()
    {
        return view('pelanggan.rekomendasi.index');
    }

    // Memproses inputan algoritma Decision Tree
    public function proses(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:0',
            'waktu' => 'required|in:santai,cepat',
        ]);

        $budget = $request->budget;
        $waktu = $request->waktu;

        // Inisiasi query builder
        $query = PaketLayanan::query();

        // 1. Cabang Pertama: Filter berdasarkan Budget (Harga <= Budget Klien)
        $query->where('harga', '<=', $budget);

        // 2. Cabang Kedua: Filter berdasarkan Waktu (Durasi Pengerjaan)
        // Misal: "Cepat" berarti butuh selesai dalam waktu maksimal 7 hari
        if ($waktu === 'cepat') {
            $query->where('durasi_pengerjaan', '<=', 7);
        }

        // Eksekusi: Ambil paket termahal yang masih masuk ke dalam batas budget klien
        $rekomendasi = $query->orderBy('harga', 'desc')->first();

        // Kembalikan ke halaman form dengan membawa hasil rekomendasi
        return view('pelanggan.rekomendasi.index', compact('rekomendasi', 'budget', 'waktu'));
    }
}
