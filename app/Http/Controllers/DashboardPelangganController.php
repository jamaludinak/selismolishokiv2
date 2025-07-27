<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Models\Kendaraan;
use App\Models\Alamat;

class DashboardPelangganController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();

        // Ambil servis terakhir
        $lastServis = $user->reservasis()->latest('created_at')->first();

        // Ambil kendaraan terbaru (maksimal 2)
        $kendaraans = $user->kendaraans()->latest()->take(2)->get();

        // Hitung jumlah alamat
        $alamatCount = $user->alamatPelanggan()->count();

        // Hitung jumlah kendaraan
        $kendaraansCount = $user->kendaraans()->count();

        // Hitung total servis
        $totalServis = $user->reservasis()->count();

        // Hitung garansi aktif (yang belum lewat tanggal akhir)
        $reservasis = $user->reservasis()->get();
        $garansiAktif = $reservasis->filter(function ($res) {
            return $res->tanggal_berakhir_garansi && $res->tanggal_berakhir_garansi->gte(now());
        })->count();

        return view('pelanggan.dashboard', compact(
            'lastServis',
            'kendaraans',
            'totalServis',
            'kendaraansCount',
            'alamatCount',
            'garansiAktif'
        ));
    }
}