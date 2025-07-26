<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\AlamatPelanggan;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data pelanggan dengan relasi alamat utama
        $query = DataPelanggan::with(['alamatPelanggan' => function($query) {
            $query->orderBy('is_utama', 'desc')->orderBy('created_at', 'asc');
        }]);
    
        // Gunakan pagination, bukan get()
        $dataPelanggan = $query->paginate(10); // 10 data per halaman
    
        return view('admin.pelanggan.index', compact('dataPelanggan'));
    }
    
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'noHP' => 'required|string|max:20',
            'alamat' => 'required|string',
            'keluhan' => 'required|string',
        ]);

        // Create pelanggan
        $pelanggan = DataPelanggan::create([
            'nama' => $request->nama,
            'noHP' => $request->noHP,
            'keluhan' => $request->keluhan,
        ]);

        // Create alamat utama
        AlamatPelanggan::create([
            'data_pelanggan_id' => $pelanggan->id,
            'alamat' => $request->alamat,
            'is_utama' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data' => $pelanggan->load('alamatPelanggan')
        ]);
    }

    public function edit($id)
    {
        $dataPelanggan = DataPelanggan::with('alamatPelanggan')->findOrFail($id);
        return response()->json($dataPelanggan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'noHP' => 'required|string|max:20',
            'alamat' => 'required|string',
            'keluhan' => 'required|string',
        ]);
    
        $dataPelanggan = DataPelanggan::findOrFail($id);
        
        // Update pelanggan
        $dataPelanggan->update([
            'nama' => $request->nama,
            'noHP' => $request->noHP,
            'keluhan' => $request->keluhan,
        ]);

        // Update alamat utama
        $alamatUtama = $dataPelanggan->alamatPelanggan()->where('is_utama', true)->first();
        if ($alamatUtama) {
            $alamatUtama->update(['alamat' => $request->alamat]);
        } else {
            // Create alamat utama if doesn't exist
            AlamatPelanggan::create([
                'data_pelanggan_id' => $dataPelanggan->id,
                'alamat' => $request->alamat,
                'is_utama' => true,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diupdate',
            'data' => $dataPelanggan->load('alamatPelanggan')
        ]);
    }

    public function destroy(DataPelanggan $dataPelanggan)
    {
        $dataPelanggan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil dihapus'
        ]);
    }
}

