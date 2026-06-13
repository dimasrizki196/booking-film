<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PaketLayananController extends Controller
{
    public function index()
    {
        $paket = PaketLayanan::latest()->get();
        return view('admin.paket.index', compact('paket'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0', // Validasi angka minimal 0
            'durasi_pengerjaan' => 'required|integer|min:1', // Minimal 1 hari
        ]);

        PaketLayanan::create($request->all());

        return redirect()->route('admin.paket.index')->with('success', 'Paket layanan berhasil ditambahkan.');
    }

    public function edit(PaketLayanan $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, PaketLayanan $paket)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'durasi_pengerjaan' => 'required|integer|min:1',
        ]);

        $paket->update($request->all());

        return redirect()->route('admin.paket.index')->with('success', 'Paket layanan berhasil diperbarui.');
    }

    public function destroy(PaketLayanan $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket layanan berhasil dihapus.');
    }
}