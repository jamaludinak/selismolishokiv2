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
        // Validasi input dasar
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'noHP' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cek apakah pelanggan dengan noHP sudah ada
        $existingPelanggan = DataPelanggan::where('noHP', $request->noHP)->first();

        if ($existingPelanggan) {
            // Jika data pelanggan sudah ada dan password sudah diset (tidak kosong)
            if (!empty($existingPelanggan->password)) {
                return back()->withErrors([
                    'noHP' => 'Nomor HP sudah terdaftar dan memiliki akun aktif. Silakan login.'
                ])->withInput();
            }
            
            // Jika data pelanggan sudah ada tetapi password kosong, update password
            $existingPelanggan->update([
                'nama' => $request->nama, // Update nama juga jika diperlukan
                'password' => Hash::make($request->password),
            ]);

            return redirect('/login-pelanggan')->with('success', 'Akun berhasil diaktifkan! Silakan login.');
        }

        // Jika belum ada data pelanggan, buat baru
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

        return view('auth.login_pelanggan')->with('success', 'Anda telah berhasil logout.');
    }
}
