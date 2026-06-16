<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_film',
        'deskripsi',
        'link_video',
        'thumbnail',
        'tanggal_upload',
    ];

    // Relasi ke User (Admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
