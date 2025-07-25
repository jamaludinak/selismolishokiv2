<?php

namespace App\Http\Controllers;

use App\Models\JenisKerusakan;
use App\Models\Reservasi;
use App\Models\Riwayat;
use App\Models\AlamatPelanggan;
use App\Models\Setting;
use App\Models\ReqJadwal;
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

        // Validasi input Home Service dengan alamat_id dan kendaraan_id
        // Validate input for authenticated Home Service form: use alamat_id and kendaraan_id
        $validatedData = $request->validate([
            'alamat_id'      => 'required|exists:alamat_pelanggans,id',
            'kendaraan_id'   => 'required|exists:kendaraans,id',
            'idJenisKerusakan'=> 'required|integer|exists:jenis_kerusakans,id',
            'deskripsi'      => 'required|string',
            'gambar'         => 'required|image|mimes:jpeg,png,jpg,gif,heic,heif',
            'video'          => 'nullable|file|mimes:mp4,mov,avi,wmv',
            'tanggal'        => 'required|date',
            'waktuMulai'     => 'required|date_format:H:i',
            'waktuSelesai'   => 'required|date_format:H:i|after:waktuMulai',
        ]);

        // Ambil data alamat berdasarkan alamat_id
        $alamat = AlamatPelanggan::findOrFail($request->alamat_id);

        // Menyimpan gambar kerusakan
        $imagePath = $request->file('gambar')->store('images/damage', 'public_direct');

        // Menyimpan video kerusakan (jika ada)
        $videoPath = $request->hasFile('video') ? $request->file('video')->store('videos/damage', 'public_direct') : null;

        // Hitung biaya perjalanan menggunakan helper dengan koordinat dari alamat
        $biayaPerjalanan = \App\Helpers\TravelCostHelper::hitungBiayaPerjalanan(
            $alamat->latitude,
            $alamat->longitude
        );

        // Membuat reservasi baru untuk Home Service
        $reservasi = new Reservasi();
        $reservasi->servis = 'Home Service';
        $reservasi->namaLengkap = $user->nama;
        $reservasi->noTelp = $user->noHP;
        // Use alamat data from alamat_id
        $reservasi->alamatLengkap = $alamat->alamat;
        $reservasi->latitude      = $alamat->latitude;
        $reservasi->longitude     = $alamat->longitude;
        $reservasi->kendaraan_id  = $validatedData['kendaraan_id'];
        $reservasi->idJenisKerusakan = $validatedData['idJenisKerusakan'];
        $reservasi->deskripsi = $validatedData['deskripsi'];
        $reservasi->gambar = $imagePath;
        $reservasi->video = $videoPath;
        $reservasi->biaya_perjalanan = $biayaPerjalanan['biaya'];

        // Set status default ke pending
        $reservasi->status = 'pending';

        // Format nomor resi untuk Home Service
        $reservasi->noResi = 'HM-' . now()->format('ymd') . strtoupper(substr(uniqid(), -2));
        $reservasi->save();

        // Buat riwayat untuk reservasi
        Riwayat::create([
            'idReservasi' => $reservasi->id,
            'status' => $reservasi->status,
        ]);

        // Tambahkan Request Jadwal
        $this->tambahRequestJadwal(new Request([
            'idReservasi' => $reservasi->id,
            'tanggal' => $validatedData['tanggal'],
            'waktuMulai' => $validatedData['waktuMulai'],
            'waktuSelesai' => $validatedData['waktuSelesai'],
        ]));

        // Redirect atau tampilkan modal setelah reservasi berhasil
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dibuat!',
            'no_resi' => $reservasi->noResi,
        ]);
    }

    public function storeGarage(Request $request)
    {
        $user = auth('pelanggan')->user();
        
        // Validasi input sesuai form Garage Service
        // Validate input for authenticated Garage Service form
        $validatedData = $request->validate([
            'idJenisKerusakan'=> 'required|integer|exists:jenis_kerusakans,id',
            'deskripsi'       => 'required|string',
            'gambar'          => 'nullable|image|mimes:jpeg,png,jpg,gif,heic,heif',
            'video'           => 'nullable|file|mimes:mp4,mov,avi,wmv',
            'kendaraan_id'    => 'required|exists:kendaraans,id',
        ]);

        // Inisialisasi variabel untuk menyimpan gambar dan video
        $imagePath = null;
        $videoPath = null;

        // Menyimpan gambar kerusakan jika ada
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images/damage', 'public_direct');
        }

        // Menyimpan video kerusakan jika ada
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos/damage', 'public_direct');
        }

        // Membuat reservasi baru untuk Garage Service
        $reservasi = new Reservasi();
        $reservasi->servis = 'Garage Service';
        $reservasi->namaLengkap = $user->nama;
        $reservasi->noTelp = $user->noHP;
        // No alamat required for garage service
        $reservasi->kendaraan_id = $validatedData['kendaraan_id'];
        $reservasi->idJenisKerusakan = $validatedData['idJenisKerusakan'];
        $reservasi->deskripsi = $validatedData['deskripsi'];
        $reservasi->gambar = $imagePath;
        $reservasi->video = $videoPath;

        // Set status default ke pending
        $reservasi->status = 'pending';

        // Format nomor resi untuk Garage Service
        $reservasi->noResi = 'GR-' . now()->format('ymd') . strtoupper(substr(uniqid(), -2));
        $reservasi->biaya_perjalanan = 0;
        $reservasi->save();

        // Buat riwayat untuk reservasi
        Riwayat::create([
            'idReservasi' => $reservasi->id,
            'status' => $reservasi->status,
        ]);

        // Redirect atau tampilkan modal setelah reservasi berhasil
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dibuat!',
            'no_resi' => $reservasi->noResi,
        ]);
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

    public function tambahRequestJadwal(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'idReservasi' => 'required|exists:reservasis,id', // Sesuaikan nama tabel jika berbeda
            'tanggal' => 'required|date',
            'waktuMulai' => 'required|date_format:H:i',
            'waktuSelesai' => 'required|date_format:H:i|after:waktuMulai',
        ]);

        // Simpan data request jadwal
        $jadwal = ReqJadwal::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Request jadwal berhasil ditambahkan.',
            'data' => $jadwal,
        ]);
    }

    public function showUploadForm()
    {
        return view('pelanggan.upload_video');
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:102400', // 100MB max
            'no_resi' => 'required|string',
        ]);

        // Mencari reservasi berdasarkan nomor resi
        $reservasi = Reservasi::where('noResi', $request->input('no_resi'))->first();

        if (!$reservasi) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak ditemukan.',
            ]);
        }

        try {
            // Simpan video ke storage
            $videoPath = $request->file('video')->store('videos/damage', 'public_direct');

            // Simpan path video ke dalam data reservasi
            $reservasi->video = $videoPath;
            $reservasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Video berhasil diupload!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupload video: ' . $e->getMessage(),
            ]);
        }
    }
}
