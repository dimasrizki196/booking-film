<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[Fillable(['nama_paket', 'deskripsi', 'detail_paket', 'harga', 'durasi_pengerjaan'])]
class PaketLayanan extends Model
{
    use HasFactory;
}
