<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index(Request $request)
    {
        $query = Ulasan::query();

        $ulasans = $query->get();

        return view('admin.ulasan.index', compact('ulasans'));
    }

    public function create()
    {
        return view('admin.ulasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ulasan' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $ulasan = Ulasan::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil ditambahkan.',
            'data' => $ulasan
        ]);
    }

    public function edit(Ulasan $ulasan)
    {
        return response()->json($ulasan);
    }

    public function update(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'ulasan' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $ulasan->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil diperbarui.',
            'data' => $ulasan
        ]);
    }

    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil dihapus.'
        ]);
    }
}
