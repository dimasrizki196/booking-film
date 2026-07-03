<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        // Mengambil semua data pemesanan beserta relasinya
        $pemesanan = Pemesanan::with(['user', 'paket', 'jadwal'])->latest()->get();
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        // Load relasi agar data pelanggan dan jadwal bisa ditampilkan di form
        $pemesanan->load(['user', 'paket', 'jadwal']);
        return view('admin.pemesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        // 1. Validasi input status, jadwal, dan alasan batal
        $request->validate([
            'status_pemesanan' => 'required|in:pending,diproses,selesai,dibatalkan',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi_produksi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            // Validasi: Alasan batal WAJIB DIISI jika status_pemesanan bernilai 'dibatalkan'
            'alasan_batal' => 'required_if:status_pemesanan,dibatalkan|nullable|string',
        ], [
            // Kustomisasi pesan error bahasa Indonesia agar lebih ramah
            'alasan_batal.required_if' => 'Alasan pembatalan wajib diisi jika Anda memilih status Dibatalkan.',
        ]);

        // 2. Logika penentuan nilai alasan_batal
        $alasanBatal = null;
        if ($request->status_pemesanan === 'dibatalkan') {
            $alasanBatal = $request->alasan_batal;
        }

        // 3. Update status pemesanan beserta alasan_batal
        $pemesanan->update([
            'status_pemesanan' => $request->status_pemesanan,
            'alasan_batal' => $alasanBatal // Menyimpan alasan ke database
        ]);

        // 4. Logika update/create Jadwal Produksi (Hanya jika status bukan dibatalkan)
        if ($request->status_pemesanan !== 'dibatalkan') {
            if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
                $pemesanan->jadwal()->updateOrCreate(
                    ['pemesanan_id' => $pemesanan->id],
                    [
                        'tanggal_mulai' => $request->tanggal_mulai,
                        'tanggal_selesai' => $request->tanggal_selesai,
                        'lokasi_produksi' => $request->lokasi_produksi,
                        'keterangan' => $request->keterangan,
                    ]
                );
            }
        } else {
            // OPSIONAL: Jika pesanan dibatalkan, Anda bisa menghapus jadwal produksi yang sempat dibuat sebelumnya (jika ada)
            if ($pemesanan->jadwal) {
                $pemesanan->jadwal()->delete();
            }
        }

        return redirect()->route('admin.pemesanan.index')->with('success', 'Status pesanan dan jadwal produksi berhasil diperbarui.');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return redirect()->route('admin.pemesanan.index')->with('success', 'Data pemesanan berhasil dihapus.');
    }
}
