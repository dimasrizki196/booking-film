<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalProduksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi_produksi',
        'keterangan'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
