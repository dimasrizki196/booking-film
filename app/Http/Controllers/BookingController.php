<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Mengambil riwayat pesanan khusus untuk user yang sedang login
        $riwayat = Pemesanan::with('paket', 'jadwal')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pelanggan.booking.index', compact('riwayat'));
    }

    public function create()
    {
        // Melempar data paket agar bisa dipilih di form dropdown/card
        $paket = PaketLayanan::all();
        return view('pelanggan.booking.create', compact('paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket_layanans,id',
            'tanggal_pengerjaan' => 'required|date|after_or_equal:today', // Minimal booking hari ini
        ]);

        // Mengambil harga asli dari database berdasarkan paket yang dipilih
        $paket = PaketLayanan::findOrFail($request->paket_id);

        Pemesanan::create([
            'user_id' => Auth::id(),
            'paket_id' => $paket->id,
            'tanggal_pesan' => now(),
            'tanggal_pengerjaan' => $request->tanggal_pengerjaan,
            'status_pemesanan' => 'pending',
            'total_harga' => $paket->harga, // Menggunakan harga asli dari DB
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil! Tim Next Project Film akan segera memproses pesanan Anda.');
    }
}
