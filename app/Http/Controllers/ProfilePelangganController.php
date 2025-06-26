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
        $user = Auth::guard('pelanggan')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:data_pelanggans,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // $user->save();

        return redirect()->route('pelanggan.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
