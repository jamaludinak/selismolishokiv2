<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Models\Kendaraan;
use App\Models\JenisKerusakan;
use Carbon\Carbon;

class RiwayatServisPelangganController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();
        $noHP = $user->noHP;
        $riwayats = Reservasi::where('noTelp', $noHP)->orderBy('created_at', 'desc')->get();
        $today = Carbon::today();
        foreach ($riwayats as $r) {
            $kendaraan = Kendaraan::find($r->kendaraan_id);
            if ($kendaraan) {
                $r->data_kendaraan = $kendaraan->merk . ' ' . $kendaraan->tipe;
            } else {
                $r->data_kendaraan = '-';
            }

            $jenisKerusakan = JenisKerusakan::find($r->idJenisKerusakan);
            if ($jenisKerusakan) {
                $r->jenis_kerusakan = $jenisKerusakan->nama;
            } else {
                $r->jenis_kerusakan = '-';
            }

            if ($r->status !== 'completed') {
                $r->status_garansi = '-';
            } else if ($r->tanggal_berakhir_garansi && $r->tanggal_berakhir_garansi >= $today) {
                $r->status_garansi = 'Aktif';
            } else {
                $r->status_garansi = 'Kadaluarsa';
            }
        }
        return view('pelanggan.riwayat.index', compact('riwayats'));
    }

    public function show($id)
    {
        $riwayat = Reservasi::find($id);
        if (!$riwayat) {
            return redirect()->route('riwayat.index')->with('error', 'Riwayat reservasi tidak ditemukan.');
        }

        $kendaraan = Kendaraan::find($riwayat->kendaraan_id);
        $riwayat->data_kendaraan = $kendaraan ? $kendaraan->merk . ' ' . $kendaraan->tipe : '-';

        $jenisKerusakan = JenisKerusakan::find($riwayat->idJenisKerusakan);
        $riwayat->jenis_kerusakan = $jenisKerusakan ? $jenisKerusakan->nama : '-';

        $today = Carbon::today();
        if ($riwayat->status !== 'completed') {
            $riwayat->status_garansi = '-';
        } else if ($riwayat->tanggal_berakhir_garansi && $riwayat->tanggal_berakhir_garansi >= $today) {
            $riwayat->status_garansi = 'Aktif';
        } else {
            $riwayat->status_garansi = 'Kadaluarsa';
        }

        return view('pelanggan.riwayat.show', compact('riwayat'));
    }
}