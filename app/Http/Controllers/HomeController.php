<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data portofolio dari yang terbaru
        $portofolio = Portofolio::latest()->get();

        // Mengambil data paket layanan
        $paket = PaketLayanan::all();

        // Mengirimkan kedua variabel tersebut ke view welcome.blade.php
        return view('welcome', compact('portofolio', 'paket'));
    }
}
