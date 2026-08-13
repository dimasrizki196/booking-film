<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        return view('pelanggan.rekomendasi.index');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:0'
        ]);

        $budget = $request->budget;

        // AMBIL SEMUA PAKET YANG HARGANYA <= BUDGET (diurutkan dari yang paling mendekati budget)
        // PERHATIKAN: gunakan ->get(), jangan ->first()
        $rekomendasi = PaketLayanan::where('harga', '<=', $budget)
            ->orderBy('harga', 'desc')
            ->get();

        $upsell = null;

        // Jika rekomendasi kosong (budget tidak cukup untuk paket termurah sekalipun)
        if ($rekomendasi->isEmpty()) {
            // Ambil 1 paket paling murah sebagai tawaran (upsell)
            $upsell = PaketLayanan::orderBy('harga', 'asc')->first();
        }
        return view('pelanggan.rekomendasi.index', compact('rekomendasi', 'upsell', 'budget'));
    }
}
