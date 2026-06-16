<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolio = Portofolio::latest()->get();
        return view('admin.portofolio.index', compact('portofolio'));
    }

    public function create()
    {
        return view('admin.portofolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_film' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link_video' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_upload' => 'required|date',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Mengambil ID admin yang sedang login

        // Proses upload gambar jika ada
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('portofolio_thumbnails', 'public');
        }

        Portofolio::create($data);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portofolio $portofolio)
    {
        return view('admin.portofolio.edit', compact('portofolio'));
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $request->validate([
            'judul_film' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link_video' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_upload' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($portofolio->thumbnail) {
                Storage::disk('public')->delete($portofolio->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('portofolio_thumbnails', 'public');
        }

        $portofolio->update($data);

        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portofolio $portofolio)
    {
        if ($portofolio->thumbnail) {
            Storage::disk('public')->delete($portofolio->thumbnail);
        }

        $portofolio->delete();
        return redirect()->route('admin.portofolio.index')->with('success', 'Portofolio berhasil dihapus.');
    }
}
