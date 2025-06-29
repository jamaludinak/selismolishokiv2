<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index(Request $request)
    {
        $query = Ulasan::query();

        // Search by name
        if ($request->filled('search_nama')) {
            $query->where('nama', 'like', '%' . $request->search_nama . '%');
        }

        // Filter by rating
        if ($request->filled('filter_rating')) {
            $query->where('rating', $request->filter_rating);
        }

        $ulasans = $query->paginate(10);

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
