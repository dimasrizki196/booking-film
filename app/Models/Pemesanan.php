<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_id',
        'tanggal_pesan',
        'tanggal_pengerjaan',
        'status_pemesanan',
        'total_harga'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketLayanan::class, 'paket_id');
    }

    public function jadwal()
    {
        return $this->hasOne(JadwalProduksi::class);
    }
}
