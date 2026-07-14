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
        // Hanya memvalidasi budget
        $request->validate([
            'budget' => 'required|numeric|min:0',
        ]);

        $budget = $request->budget;

        // 1. Rekomendasi Utama (Paket terbaik yang MUAT di budget)
        $rekomendasi = PaketLayanan::where('harga', '<=', $budget)
            ->orderBy('harga', 'desc')
            ->first();

        // 2. Rekomendasi Alternatif / Upsell (Satu tingkat DI ATAS budget)
        $upsell = PaketLayanan::where('harga', '>', $budget)
            ->orderBy('harga', 'asc')
            ->first();

        return view('pelanggan.rekomendasi.index', compact('rekomendasi', 'upsell', 'budget'));
    }
}
