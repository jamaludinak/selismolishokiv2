<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;

class RiwayatServisPelangganController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();

        // Ambil semua reservasi milik pelanggan yang sudah selesai
        $riwayats = Reservasi::with(['jenisKerusakan', 'kendaraan', 'klaimGaransi']) // 👈 tambah klaimGaransi
            ->where('noTelp', $user->noHP)
            ->where('status', 'completed')
            ->orderByDesc('created_at')
            ->get();

        return view('pelanggan.riwayats.index', compact('riwayats'));
    }

}
