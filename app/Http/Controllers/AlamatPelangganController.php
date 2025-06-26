<?php

namespace App\Http\Controllers;

use App\Models\AlamatPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatPelangganController extends Controller
{
    // Tampilkan semua alamat milik pelanggan yang sedang login
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        $alamats = $user->alamatPelanggan;
        return view('pelanggan.alamat.index', compact('alamats'));
    }

    // Tampilkan form tambah alamat
    public function create()
    {
        return view('pelanggan.alamat.create');
    }

    // Simpan alamat baru
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        $user = Auth::guard('pelanggan')->user();
        $data = $request->all();
        $data['data_pelanggan_id'] = $user->id;
        AlamatPelanggan::create($data);
        return redirect()->route('profile.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    // Tampilkan form edit alamat
    public function edit($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $alamat = AlamatPelanggan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        return view('pelanggan.alamat.edit', compact('alamat'));
    }

    // Update alamat
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        $user = Auth::guard('pelanggan')->user();
        $alamat = AlamatPelanggan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        $alamat->update($request->all());
        return redirect()->route('profile.index')->with('success', 'Alamat berhasil diupdate.');
    }

    // Hapus alamat
    public function destroy($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $alamat = AlamatPelanggan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        $alamat->delete();
        return redirect()->route('profile.index')->with('success', 'Alamat berhasil dihapus.');
    }

    public function jadikanUtama($id)
    {
        $user = Auth::guard('pelanggan')->user();

        // Reset semua alamat menjadi bukan utama
        $user->alamatPelanggan()->update(['is_utama' => false]);

        // Set alamat terpilih menjadi utama
        $alamat = $user->alamatPelanggan()->findOrFail($id);
        $alamat->is_utama = true;
        $alamat->save();

        return redirect()->route('profile.index')->with('success', 'Alamat berhasil dijadikan alamat utama.');
    }
}
