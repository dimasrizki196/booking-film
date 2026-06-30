<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Wajib di-import untuk manipulasi tanggal

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
        $paket = PaketLayanan::all();

        $minDate = Carbon::today()->addDays(3)->format('Y-m-d');

        return view('pelanggan.booking.create', compact('paket', 'minDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket_layanans,id',
            'tanggal_pengerjaan' => 'required|date|after_or_equal:today', // Minimal booking hari ini
        ]);

        $paket = PaketLayanan::findOrFail($request->paket_id);

        Pemesanan::create([
            'user_id' => Auth::id(),
            'paket_id' => $paket->id,
            'tanggal_pesan' => now(),
            'tanggal_pengerjaan' => $request->tanggal_pengerjaan,
            'catatan_customer' => $request->catatan_customer, // Menyimpan catatan ke database
            'status_pemesanan' => 'pending',
            'total_harga' => $paket->harga,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil! Tim Next Project Film akan segera memproses pesanan Anda.');
    }
}
