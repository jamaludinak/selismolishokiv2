<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
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
            if ($r->tanggal_berakhir_garansi && $r->tanggal_berakhir_garansi >= $today) {
                $r->status_garansi = 'Aktif';
            } else {
                $r->status_garansi = 'Kadaluarsa';
            }
        }
        return view('pelanggan.riwayat.index', compact('riwayats'));
    }
} 