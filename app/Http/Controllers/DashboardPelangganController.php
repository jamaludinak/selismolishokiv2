<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPelangganController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();

        $lastServis = $user->reservasis()->latest('created_at')->first();
        $kendaraans = $user->kendaraans;

        // Hitung total servis
        $totalServis = $user->reservasis()->count();

        // Hitung total kendaraan
        $totalKendaraan = $kendaraans->count();

        $kendaraans = $user->kendaraans()->latest()->take(2)->get();

        // Hitung garansi aktif (yang belum lewat tanggal akhir) via collection filter
        $reservasis = $user->reservasis()->get();
        $garansiAktif = $reservasis->filter(function ($res) {
            return $res->tanggal_berakhir_garansi && $res->tanggal_berakhir_garansi->gte(now());
        })->count();

        return view('pelanggan.dashboard', compact(
            'lastServis',
            'kendaraans',
            'totalServis',
            'totalKendaraan',
            'garansiAktif'
        ));
    }
}
