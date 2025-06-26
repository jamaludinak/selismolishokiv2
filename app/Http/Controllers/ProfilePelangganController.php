<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DataPelanggan;

class ProfilePelangganController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        $alamats = $user->alamatPelanggan;

        return view('pelanggan.profile.index', compact('user', 'alamats'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('pelanggan')->user(); // ✅ Eloquent instance

        $request->validate([
            'nama' => 'required|string|max:255',
            'noHP' => 'required|string|unique:data_pelanggans,noHP,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->nama = $request->nama;
        $user->noHP = $request->noHP;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        /** @var \App\Models\DataPelanggan $user */

        $user->save();


        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
