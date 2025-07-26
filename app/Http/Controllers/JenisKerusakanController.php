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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_kerusakans,nama',
            'biaya_estimasi' => 'nullable|numeric|min:0',
        ]);

        JenisKerusakan::create($request->all());
        return redirect()->route('jenis_kerusakan.index')->with('success', 'Jenis kerusakan berhasil ditambahkan.');
    }

    public function update(Request $request, JenisKerusakan $jenisKerusakan)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_kerusakans,nama,' . $jenisKerusakan->id,
            'biaya_estimasi' => 'nullable|numeric|min:0',
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
