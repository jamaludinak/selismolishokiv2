<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    // Tampilkan semua kendaraan milik pelanggan yang sedang login
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        $kendaraans = $user->kendaraans;
        return view('pelanggan.kendaraan.index', compact('kendaraans'));
    }

    // Tampilkan form tambah kendaraan
    public function create()
    {
        return view('pelanggan.kendaraan.create');
    }

    // Simpan kendaraan baru
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|in:sepeda_listrik,motor_listrik',
            'tipe' => 'nullable|string|max:255',
            'nomor_rangka' => 'nullable|string|max:255',
            'tahun_pembelian' => 'required|digits:4|integer|min:2000|max:' . (date('Y')+1),
            'status_garansi' => 'required|in:aktif,tidak_aktif',
        ]);
        $user = Auth::guard('pelanggan')->user();
        $data = $request->all();
        $data['data_pelanggan_id'] = $user->id;
        Kendaraan::create($data);
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    // Tampilkan form edit kendaraan
    public function edit($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $kendaraan = Kendaraan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        return view('pelanggan.kendaraan.edit', compact('kendaraan'));
    }

    // Update kendaraan
    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|in:sepeda_listrik,motor_listrik',
            'tipe' => 'nullable|string|max:255',
            'nomor_rangka' => 'nullable|string|max:255',
            'tahun_pembelian' => 'required|digits:4|integer|min:2000|max:' . (date('Y')+1),
            'status_garansi' => 'required|in:aktif,tidak_aktif',
        ]);
        $user = Auth::guard('pelanggan')->user();
        $kendaraan = Kendaraan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        $kendaraan->update($request->all());
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diupdate.');
    }

    // Hapus kendaraan
    public function destroy($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $kendaraan = Kendaraan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }
} 