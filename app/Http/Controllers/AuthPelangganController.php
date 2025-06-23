<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthPelangganController extends Controller
{
    // Menampilkan halaman login pelanggan
    public function showLoginForm()
    {
        return view('auth.login_pelanggan');
    }

    // Proses login pelanggan
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'noHP' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('pelanggan')->attempt(['noHP' => $credentials['noHP'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-pelanggan');
        }

        return back()->withErrors([
            'noHP' => 'Nomor HP atau password salah.',
        ]);
    }

    // Menampilkan halaman registrasi pelanggan
    public function showRegisterForm()
    {
        return view('auth.register_pelanggan');
    }

    // Proses registrasi pelanggan
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'noHP' => 'required|string|max:20|unique:data_pelanggans',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DataPelanggan::create([
            'nama' => $request->nama,
            'noHP' => $request->noHP,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login-pelanggan')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses logout pelanggan
    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-pelanggan');
    }
} 