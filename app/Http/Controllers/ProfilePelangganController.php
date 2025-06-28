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
            // 'noHP' => 'required|string|unique:data_pelanggans,noHP,' . $user->id,
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|same:password',
        ], [
            'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan password baru.',
        ]);

        $user->nama = $request->nama;
        // $user->noHP = $request->noHP;

        // Update password only if both password and confirmation are provided
        if ($request->filled('password') && $request->filled('password_confirmation')) {
            if ($request->password === $request->password_confirmation) {
                $user->password = Hash::make($request->password);
            } else {
                return back()->withErrors(['password_confirmation' => 'Konfirmasi password tidak cocok dengan password baru.']);
            }
        } elseif ($request->filled('password') && !$request->filled('password_confirmation')) {
            return back()->withErrors(['password_confirmation' => 'Konfirmasi password harus diisi jika ingin mengubah password.']);
        } elseif (!$request->filled('password') && $request->filled('password_confirmation')) {
            return back()->withErrors(['password' => 'Password baru harus diisi jika ingin mengubah password.']);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
