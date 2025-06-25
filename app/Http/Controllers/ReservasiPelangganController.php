<?php

namespace App\Http\Controllers;

use App\Models\JenisKerusakan;
use App\Models\Reservasi;
use App\Models\Riwayat;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservasiPelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pelanggan');
    }

    public function index()
    {
        $user = auth('pelanggan')->user();

        $reservasis = Reservasi::where('noTelp', $user->noHP)
            ->where('status', '!=', 'completed')
            ->with('jenisKerusakan')
            ->orderByDesc('created_at')
            ->get();

        return view('pelanggan.reservasi.index', compact('reservasis'));
    }

    public function history()
    {
        $user = auth('pelanggan')->user();

        $reservasis = Reservasi::where('noTelp', $user->noHP)
            ->where('status', 'completed')
            ->with('jenisKerusakan')
            ->orderByDesc('created_at')
            ->get();

        return view('pelanggan.reservasi.history', compact('reservasis'));
    }

    public function create()
    {
        $jenisKerusakan = JenisKerusakan::all();
        $user = auth('pelanggan')->user();
        $alamat = $user->alamat;
        $nomor = $user->noHP;

        return view('pelanggan.reservasi.create', compact('jenisKerusakan', 'alamat', 'nomor'));
    }

    public function store(Request $request)
    {
        $user = auth('pelanggan')->user();

        $validatedData = $request->validate([
            'idJenisKerusakan' => 'required|exists:jenis_kerusakans,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|string',
            'video' => 'nullable|string',
            'servis' => 'required|string|in:home,garage',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        $bengkelLonglat = Setting::where('key', 'bengkel_longlat')->first();
        $tarifPerKm = Setting::where('key', 'tarif_per_km')->first();
        $biayaPerKm = $tarifPerKm ? (int)$tarifPerKm->value : 5000;
        $biayaPerjalanan = 0;

        if ($bengkelLonglat) {
            [$bengkelLong, $bengkelLat] = explode(',', $bengkelLonglat->value);
            $jarak = $this->haversineDistance($request->latitude, $request->longitude, $bengkelLat, $bengkelLong);
            $biayaPerjalanan = ceil($jarak) * $biayaPerKm;
        }

        $noResi = 'RSV-' . strtoupper(Str::random(10));

        $reservasi = Reservasi::create(array_merge($validatedData, [
            'namaLengkap' => $user->nama,
            'alamatLengkap' => $user->alamat,
            'noTelp' => $user->noHP,
            'noResi' => $noResi,
            'status' => 'pending',
            'biaya_perjalanan' => $biayaPerjalanan,
        ]));

        Riwayat::create([
            'idReservasi' => $reservasi->id,
            'status' => $reservasi->status,
        ]);

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil ditambahkan.');
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
