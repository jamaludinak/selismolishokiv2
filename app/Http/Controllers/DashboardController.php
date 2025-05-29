<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Ulasan;
use App\Models\DataPelanggan;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data for the dashboard
        $totalReservasi = Reservasi::count();
        $homeServiceReservasi = Reservasi::where('servis', 'Home Service')->count();
        $bengkelReservasi = Reservasi::where('servis', 'Garage Service')->count();
        $averageRating = Ulasan::avg('rating'); // Get average rating from ulasans
        $totalPelanggan = DataPelanggan::count();

        return view('admin.dashboard', compact('totalReservasi', 'homeServiceReservasi', 'bengkelReservasi', 'averageRating', 'totalPelanggan'));
    }
}
