<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $pelanggan = User::where('role', 'pelanggan')->latest()->get();
        return view('admin.users.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan', // Otomatis diset sebagai pelanggan
        ]);

        // 3. Redirect kembali ke index dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        // Model binding otomatis mengambil data user berdasarkan ID
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // 1. Validasi input (Pengecualian email unique untuk user yang sedang diedit)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat edit
        ]);

        // 2. Update data
        $user->name = $request->name;
        $user->email = $request->email;

        // Cek apakah password diisi (ingin diganti)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // 3. Redirect
        return redirect()->route('admin.users.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
