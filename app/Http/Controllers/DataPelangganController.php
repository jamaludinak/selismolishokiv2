<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\AlamatPelanggan;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query dasar dengan relasi alamat
        $query = DataPelanggan::with(['alamatPelanggan' => function($query) {
            $query->orderBy('is_utama', 'desc')->orderBy('created_at', 'asc');
        }]);
    
        // Cek apakah ada parameter pencarian yang diberikan
        if ($request->filled('searchNama')) {
            $query->where('nama', 'like', '%' . $request->searchNama . '%');
        }
    
        if ($request->filled('searchKode')) {
            $query->where('kode', 'like', '%' . $request->searchKode . '%');
        }
    
        if ($request->filled('searchNoHP')) {
            $query->where('noHP', 'like', '%' . $request->searchNoHP . '%');
        }
    
        // Mengambil data dengan pagination
        $dataPelanggan = $query->paginate(10);
    
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

