<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KlaimGaransi;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KlaimGaransiController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        $reservasis = Reservasi::where('status', 'selesai')
            ->where('tanggal_berakhir_garansi', '>=', now())
            ->where('noTelp', $user->noHP)
            ->doesntHave('klaimGaransi')
            ->get();

        $klaimGaransis = KlaimGaransi::with('reservasi')
            ->whereHas('reservasi', function ($query) use ($user) {
                $query->where('noTelp', $user->noHP);
            })
            ->orderByDesc('created_at')
            ->get();

        return view('pelanggan.klaim_garansi.index', compact('klaimGaransis', 'reservasis'));
    }

    public function create($noResi)
    {
        $reservasi = Reservasi::where('noResi', $noResi)
            ->where('status', 'completed')
            ->where('tanggal_berakhir_garansi', '>=', now())
            ->firstOrFail();

        $cekKlaim = KlaimGaransi::where('reservasi_id', $reservasi->id)->exists();
        if ($cekKlaim) {
            return redirect()->route('klaim-garansi.index')->with('error', 'Anda sudah mengajukan klaim untuk reservasi ini.');
        }

        return view('pelanggan.klaim_garansi.create', compact('reservasi'));
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'reservasi_id' => 'required|exists:reservasis,id',
            'bukti' => 'required|image|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $path = $request->file('bukti')->store('bukti_klaim', 'public');

        KlaimGaransi::create([
            'reservasi_id' => $validated['reservasi_id'],
            'bukti' => $path,
            'keterangan' => $validated['keterangan'],
            'status' => 'diajukan',
        ]);

        return redirect()->route('riwayats.index')->with('success', 'Klaim garansi berhasil diajukan.');
    }
}
