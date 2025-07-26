<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\AlamatPelanggan;
use Illuminate\Http\Request;

class DataPelangganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data pelanggan dengan relasi alamat utama untuk client-side processing
        $query = DataPelanggan::with(['alamatPelanggan' => function($query) {
            $query->orderBy('is_utama', 'desc')->orderBy('created_at', 'asc');
        }]);
    
        $dataPelanggan = $query->get();
        
        // If AJAX request, return JSON data
        if ($request->ajax() || $request->wantsJson()) {
            $pelangganData = $dataPelanggan->map(function($item) {
                return [
                    'id' => $item->id,
                    'kode' => $item->kode,
                    'nama' => $item->nama,
                    'noHP' => $item->noHP,
                    'alamat' => $item->alamatPelanggan->first()->alamat ?? 'Tidak ada alamat',
                    'keluhan' => $item->keluhan
                ];
            })->values();
            
            return response()->json(['pelanggan' => $pelangganData]);
        }
        
        return view('admin.pelanggan.index', compact('dataPelanggan'));
    }
    
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        try {
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $dataPelanggan = DataPelanggan::with('alamatPelanggan')->findOrFail($id);
        return response()->json($dataPelanggan);
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dataPelanggan = DataPelanggan::findOrFail($id);
            
            // Delete all related alamat first
            $dataPelanggan->alamatPelanggan()->delete();
            
            // Delete the customer
            $dataPelanggan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data pelanggan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}

