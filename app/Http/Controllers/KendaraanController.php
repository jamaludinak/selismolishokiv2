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
            'tanggal_berakhir_garansi' => 'nullable|date|after:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Auth::guard('pelanggan')->user();
        $data = $request->all();
        $data['data_pelanggan_id'] = $user->id;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kendaraan'), $filename);
            $data['foto'] = 'uploads/kendaraan/' . $filename;
        }
        Kendaraan::create($data);
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    // Tampilkan detail kendaraan
    public function show($id)
    {
        $user = Auth::guard('pelanggan')->user();
        $kendaraan = Kendaraan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();

        $reservasi = $kendaraan->reservasis()->select('reservasis.id', 'noResi', 'reservasis.updated_at as tanggal', 'jenis_kerusakans.nama as nama_jenis_kerusakan')
            ->join('jenis_kerusakans', 'reservasis.idJenisKerusakan', '=', 'jenis_kerusakans.id')
            ->get();

        // Ambil noResi terbaru yang masih memiliki garansi aktif untuk klaim garansi
        $reservasiAktifGaransi = $kendaraan->reservasis()
            ->where('status', 'completed')
            ->where('tanggal_berakhir_garansi', '>=', now())
            ->whereDoesntHave('klaimGaransi')
            ->orderBy('updated_at', 'desc')
            ->first();

        return view('pelanggan.kendaraan.show', compact('kendaraan', 'reservasi', 'reservasiAktifGaransi'));
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
            'tanggal_berakhir_garansi' => 'nullable|date|after:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Auth::guard('pelanggan')->user();
        $kendaraan = Kendaraan::where('id', $id)->where('data_pelanggan_id', $user->id)->firstOrFail();
        $data = $request->except('_token', '_method');
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kendaraan'), $filename);
            $data['foto'] = 'uploads/kendaraan/' . $filename;
        }
        $kendaraan->update($data);
        return redirect()->route('kendaraan.index')->with('success', 'Perubahan data kendaraan berhasil disimpan.');
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