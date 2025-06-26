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

        // Hitung garansi aktif (yang belum lewat tanggal akhir)
        $garansiAktif = $user->reservasis()
            ->where('tanggal_berakhir_garansi', '>=', now())
            ->count();

        return view('pelanggan.dashboard', compact(
            'lastServis',
            'kendaraans',
            'totalServis',
            'totalKendaraan',
            'garansiAktif'
        ));
    }
}
