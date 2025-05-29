<?php

namespace App\Http\Controllers;

use App\Models\JenisKerusakan;
use Illuminate\Http\Request;

class JenisKerusakanController extends Controller
{
    public function index()
    {
        $jenisKerusakan = JenisKerusakan::all();
        return view('admin.jenis_kerusakan.index', compact('jenisKerusakan'));
    }

    public function create()
    {
        return view('admin.jenis_kerusakan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisKerusakan::create($request->all());
        return redirect()->route('jenis_kerusakan.index')->with('success', 'Jenis kerusakan berhasil ditambahkan.');
    }

    public function edit(JenisKerusakan $jenisKerusakan)
    {
        return view('admin.jenis_kerusakan.edit', compact('jenisKerusakan'));
    }

    public function update(Request $request, JenisKerusakan $jenisKerusakan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jenisKerusakan->update($request->all());
        return redirect()->route('jenis_kerusakan.index')->with('success', 'Jenis kerusakan berhasil diperbarui.');
    }

    public function destroy(JenisKerusakan $jenisKerusakan)
    {
        $jenisKerusakan->delete();
        return redirect()->route('jenis_kerusakan.index')->with('success', 'Jenis kerusakan berhasil dihapus.');
    }
}
