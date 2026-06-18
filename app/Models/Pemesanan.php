<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // Sesuai nama tabel di DB

    protected $fillable = [
        'user_id',
        'paket_id',
        'tanggal_pesan',
        'tanggal_pengerjaan',
        'status_pemesanan',
        'total_harga'
    ];

    // PERBAIKAN DI SINI
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(PaketLayanan::class, 'paket_id', 'id');
    }

    public function jadwal()
    {
        return $this->hasOne(JadwalProduksi::class, 'pemesanan_id', 'id');
    }
}
