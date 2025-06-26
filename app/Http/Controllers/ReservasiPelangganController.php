<?php

namespace App\Http\Controllers;

use App\Models\JenisKerusakan;
use App\Models\Reservasi;
use App\Models\Riwayat;
use App\Models\AlamatPelanggan;
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
        $user = auth('pelanggan')->user();

        $jenisKerusakan = JenisKerusakan::all();
        $alamatList = $user->alamatPelanggan;
        $kendaraanList = $user->kendaraans;
        $nomor = $user->noHP;

        return view('pelanggan.reservasi.create', compact(
            'jenisKerusakan',
            'alamatList',
            'kendaraanList',
            'nomor'
        ));
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

    public function storeGarage(Request $request)
    {
        $alamat = AlamatPelanggan::findOrFail($request->alamat_id);
        $user = auth('pelanggan')->user();
        $validatedData = $request->validate([
            'namaLengkap' => 'required|string',
            'noTelp' => 'required|string',
            'idJenisKerusakan' => 'required|exists:jenis_kerusakans,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image',
            'tanggal' => 'required|date',
            'waktuMulai' => 'required',
            'waktuSelesai' => 'required',
            'servis' => 'required|string|in:home,garage',
            'alamat_id' => 'required|exists:alamat_pelanggans,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
        ]);

        $alamat = AlamatPelanggan::findOrFail($request->alamat_id);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_kerusakan', 'public');
        }

        $noResi = 'RSV-' . strtoupper(Str::random(10));

        $reservasi = Reservasi::create([
            'noResi' => $noResi,
            'namaLengkap' => $validatedData['namaLengkap'],
            'noTelp' => $validatedData['noTelp'],
            'alamatLengkap' => $alamat->alamat,
            'longitude' => $alamat->longitude,
            'latitude' => $alamat->latitude,
            'kendaraan_id' => $validatedData['kendaraan_id'], // <- ini tambahan penting
            'idJenisKerusakan' => $validatedData['idJenisKerusakan'],
            'deskripsi' => $validatedData['deskripsi'],
            'gambar' => $gambarPath,
            'tanggal' => $validatedData['tanggal'],
            'waktuMulai' => $validatedData['waktuMulai'],
            'waktuSelesai' => $validatedData['waktuSelesai'],
            'servis' => 'garage',
            'status' => 'pending',
            'biaya_perjalanan' => 0,
        ]);
        
        Riwayat::create([
            'idReservasi' => $reservasi->id,
            'status' => $reservasi->status,
        ]);

        return response()->json(['success' => true, 'no_resi' => $reservasi->noResi]);
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
