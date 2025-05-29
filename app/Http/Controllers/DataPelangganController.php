<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query dasar
        $query = DataPelanggan::query();
    
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
    
        // Mengambil data dengan pagination atau sesuai kebutuhan
        $dataPelanggan = $query->paginate(10); // Misalnya 10 per halaman
    
        return view('admin.pelanggan.index', compact('dataPelanggan'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'noHP' => 'required',
            'alamat' => 'required',
            'keluhan' => 'required',
        ]);

        DataPelanggan::create($request->only(['nama', 'noHP', 'alamat', 'keluhan']));
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Mencari DataPelanggan berdasarkan ID
        $dataPelanggan = DataPelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('dataPelanggan'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'noHP' => 'required',
            'alamat' => 'required',
            'keluhan' => 'required',
        ]);
    
        // Mencari DataPelanggan berdasarkan ID
        $dataPelanggan = DataPelanggan::findOrFail($id);
        
        // Memperbarui data pelanggan
        $dataPelanggan->update($request->only(['nama', 'noHP', 'alamat', 'keluhan']));
        
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate');
    }

    public function destroy(DataPelanggan $dataPelanggan)
    {
        $dataPelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus');
    }
}

