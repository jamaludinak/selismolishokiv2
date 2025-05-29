<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi; 
use App\Models\JenisKerusakan;
use App\Models\Riwayat;
use App\Models\Jadwal;
use App\Models\Ulasan;
use App\Models\DataPelanggan;
use App\Models\ReqJadwal;

use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    // Menampilkan form reservasi untuk Home Service
    public function create()
    {
        $jenisKerusakan = JenisKerusakan::all();
        return view('services.servis', compact('jenisKerusakan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'noTelp' => 'required|string|max:20',
            'alamatLengkap' => 'required|string',
            'idJenisKerusakan' => 'required|integer|exists:jenis_kerusakans,id',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,heic,heif', // Tambahkan format HEIC dan HEIF
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv', // MOV sudah didukung
            'tanggal' => 'required|date', // Tambahkan validasi tanggal
            'waktuMulai' => 'required|date_format:H:i', // Tambahkan validasi waktu mulai
            'waktuSelesai' => 'required|date_format:H:i|after:waktuMulai', // Validasi waktu selesai
        ]);
    
        // Menyimpan gambar kerusakan
        $imagePath = $request->file('gambar')->store('images/damage', 'public');
    
        // Menyimpan video kerusakan (jika ada)
        $videoPath = $request->hasFile('video') ? $request->file('video')->store('videos/damage', 'public') : null;
    
        // Membuat reservasi baru untuk Home Service
        $reservasi = new Reservasi();
        $reservasi->servis = 'Home Service';
        $reservasi->namaLengkap = $validatedData['namaLengkap'];
        $reservasi->noTelp = $validatedData['noTelp'];
        $reservasi->alamatLengkap = $validatedData['alamatLengkap'];
        $reservasi->idJenisKerusakan = $validatedData['idJenisKerusakan'];
        $reservasi->deskripsi = $validatedData['deskripsi'];
        $reservasi->gambar = $imagePath;
        $reservasi->video = $videoPath;
        
        // Set status default ke pending
        $reservasi->status = 'pending';
    
        // Format nomor resi untuk Home Service
        $reservasi->noResi = 'HM-' . now()->format('ymd') . strtoupper(substr(uniqid(), -2));
        $reservasi->save();
        
        // Cek apakah pelanggan sudah ada berdasarkan noTelp
        $pelanggan = DataPelanggan::where('noHP', $request->noTelp)->first();
    
        // Jika pelanggan tidak ada, buat pelanggan baru
        if (!$pelanggan) {
            $pelanggan = DataPelanggan::create([
                'nama' => $request->namaLengkap,
                'noHP' => $request->noTelp,
                'alamat' => $request->alamatLengkap,
                'keluhan' => $request->deskripsi,
            ]);
        } else {
            // Jika pelanggan sudah ada, Anda bisa memperbarui data jika perlu
            $pelanggan->update([
                'nama' => $request->namaLengkap,
                'alamat' => $request->alamatLengkap,
                'keluhan' => $request->deskripsi,
            ]);
        }
        
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
        // Validasi input
        $validatedData = $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'noTelp' => 'required|string|max:20',
            'alamatLengkap' => 'required|string', // Jika ingin menambahkan field ini
            'idJenisKerusakan' => 'required|integer|exists:jenis_kerusakans,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic,heif', // Tambahkan format HEIC dan HEIF
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv', // MOV sudah didukung
            'tanggal' => 'required|date', // Validasi tanggal
            'waktuMulai' => 'required|date_format:H:i', // Validasi waktu mulai
            'waktuSelesai' => 'required|date_format:H:i|after:waktuMulai', // Validasi waktu selesai
        ]);
    
        // Inisialisasi variabel untuk menyimpan gambar dan video
        $imagePath = null;
        $videoPath = null;
    
        // Menyimpan gambar kerusakan jika ada
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('images/damage', 'public');
        }
    
        // Menyimpan video kerusakan jika ada
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos/damage', 'public');
        }
    
        // Membuat reservasi baru untuk Garage Service
        $reservasi = new Reservasi();
        $reservasi->servis = 'Garage Service';
        $reservasi->namaLengkap = $validatedData['namaLengkap'];
        $reservasi->noTelp = $validatedData['noTelp'];
        $reservasi->alamatLengkap = $validatedData['alamatLengkap'];
        $reservasi->idJenisKerusakan = $validatedData['idJenisKerusakan'];
        $reservasi->deskripsi = $validatedData['deskripsi'];
        $reservasi->gambar = $imagePath;
        $reservasi->video = $videoPath;
    
        // Set status default ke pending
        $reservasi->status = 'pending';
    
        // Format nomor resi untuk Garage Service
        $reservasi->noResi = 'GR-' . now()->format('ymd') . strtoupper(substr(uniqid(), -2));
        $reservasi->save();
        
        // Cek apakah pelanggan sudah ada berdasarkan noTelp
        $pelanggan = DataPelanggan::where('noHP', $request->noTelp)->first();
    
        // Jika pelanggan tidak ada, buat pelanggan baru
        if (!$pelanggan) {
            $pelanggan = DataPelanggan::create([
                'nama' => $request->namaLengkap,
                'noHP' => $request->noTelp,
                'alamat' => $request->alamatLengkap,
                'keluhan' => $request->deskripsi,
            ]);
        } else {
            // Jika pelanggan sudah ada, Anda bisa memperbarui data jika perlu
            $pelanggan->update([
                'nama' => $request->namaLengkap,
                'alamat' => $request->alamatLengkap,
                'keluhan' => $request->deskripsi,
            ]);
        }
    
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


    // Menampilkan form reservasi untuk Garage Service
    public function createGarage()
    {
        $jenisKerusakan = JenisKerusakan::all();
        return view('services.servisgarage', compact('jenisKerusakan'));
    }

    public function formCekResi(){
        return view('services.cekresi');
    }
     // Fungsi untuk cek resi
    public function cekResi($noResi)
    {
        // Cari reservasi berdasarkan noResi
        $reservasi = Reservasi::where('noResi', $noResi)->first();

        // Jika tidak ditemukan
        if (!$reservasi) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor resi tidak ditemukan.'
            ]);
        }

        // Ambil riwayat status reservasi
        $riwayat = Riwayat::where('idReservasi', $reservasi->id)->orderBy('created_at', 'desc')->get();

        // Inisialisasi jadwal
        $jadwal = null;

        // Jika status confirmed, tambahkan data jadwal
        if ($reservasi->status == 'confirmed') {
            $jadwal = Jadwal::where('idReservasi', $reservasi->id)->first();
        }

        // Ubah nilai status ke dalam format yang lebih user-friendly
        $statusMapping = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Sudah Konfirmasi',
            'process' => 'Proses Perbaikan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        // Format respons data
        $response = [
            'success' => true,
            'data' => [
                'namaLengkap' => $reservasi->namaLengkap,
                'noTelp' => $reservasi->noTelp,
                'servis' => $reservasi->servis,
                'deskripsi' => $reservasi->deskripsi,
                'status' => $statusMapping[$reservasi->status] ?? $reservasi->status, // Gunakan mapping atau default ke status asli
                'riwayat' => $riwayat,
                'jadwal' => $jadwal ? [
                    'tanggal' => $jadwal->tanggal,
                    'waktuMulai' => $jadwal->waktuMulai,
                    'waktuSelesai' => $jadwal->waktuSelesai,
                ] : null
            ]
        ];

        return response()->json($response);
    }
    
    public function showUploadForm()
    {
        return view('services.upload_video');
    }
    
    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi,wmv',
            'no_resi' => 'required|string', // Validasi nomor resi
        ]);
    
        // Mencari reservasi berdasarkan nomor resi
        $reservasi = Reservasi::where('noResi', $request->input('no_resi'))->first();
    
        if (!$reservasi) {
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak ditemukan.',
            ]);
        }
    
        // Simpan video ke storage
        $videoPath = $request->file('video')->store('videos/damage', 'public');
    
        // Simpan path video ke dalam data reservasi
        $reservasi->video = $videoPath;
        $reservasi->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Video berhasil diupload!',
        ]);
    }

    public function formTambahUlasan()
    {
        return view('services.tambahulasan'); // Arahkan ke view form tambah ulasan
    }

    // Fungsi untuk menambah ulasan
    public function tambahUlasan(Request $request)
    {
        // Validasi input noResi dan noTelp
        $validatedData = $request->validate([
            'noResi' => 'required|string|exists:reservasis,noResi',
            'noTelp' => 'required|string',
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Cek apakah noResi dan noTelp sesuai dengan data reservasi
        $reservasi = Reservasi::where('noResi', $validatedData['noResi'])
                              ->where('noTelp', $validatedData['noTelp'])
                              ->first();

        if (!$reservasi) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor resi dan nomor telepon tidak cocok.'
            ]);
        }

        // Jika validasi berhasil, simpan ulasan
        Ulasan::create([
            'nama' => $reservasi->namaLengkap,
            'ulasan' => $validatedData['ulasan'],
            'rating' => $validatedData['rating'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil disimpan.'
        ]);
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
}