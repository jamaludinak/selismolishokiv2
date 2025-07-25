<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\JenisKerusakan;
use App\Models\Riwayat;
use App\Models\DataPelanggan;
use App\Models\ReqJadwal;
use App\Models\Setting;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        // Menerima input pencarian dan filter
        $searchResi = $request->input('searchResi');
        $searchNama = $request->input('searchNama');
        $filterJenisKerusakan = $request->input('jenisKerusakan');
    
        // Query untuk reservasi yang belum 'completed'
        $reservasis = Reservasi::with(['jenisKerusakan', 'reqJadwals', 'teknisi']) // Tambahkan relasi teknisi
            ->where('status', '!=', 'completed')
            ->when($searchResi, function ($query, $searchResi) {
                return $query->where('noResi', 'like', "%{$searchResi}%");
            })
            ->when($searchNama, function ($query, $searchNama) {
                return $query->where('namaLengkap', 'like', "%{$searchNama}%");
            })
            ->when($filterJenisKerusakan, function ($query, $filterJenisKerusakan) {
                return $query->where('idJenisKerusakan', $filterJenisKerusakan);
            })
            ->paginate(10);
    
        $jenisKerusakan = JenisKerusakan::all();
    
        return view('admin.reservasi.index', compact('reservasis', 'jenisKerusakan'));
    }

    public function history(Request $request)
    {
        // Menerima input pencarian dan filter
        $searchResi = $request->input('searchResi');
        $searchNama = $request->input('searchNama');
        $searchKodePelanggan = $request->input('kodePelanggan');
        $filterJenisKerusakan = $request->input('jenisKerusakan');
    
        // Query awal untuk reservasi yang sudah 'completed'
        $reservasiQuery = Reservasi::with(['jenisKerusakan', 'teknisi']) // Tambahkan relasi teknisi
            ->where('status', 'completed')
            ->when($searchResi, function ($query, $searchResi) {
                return $query->where('noResi', 'like', "%{$searchResi}%");
            })
            ->when($searchNama, function ($query, $searchNama) {
                return $query->where('namaLengkap', 'like', "%{$searchNama}%");
            })
            ->when($filterJenisKerusakan, function ($query, $filterJenisKerusakan) {
                return $query->where('idJenisKerusakan', $filterJenisKerusakan);
            })
            ->when($searchKodePelanggan, function ($query, $searchKodePelanggan) {
                // Lakukan join dengan tabel data_pelanggans untuk mengakses kolom noTelp
                $query->join('data_pelanggans', 'reservasis.noTelp', '=', 'data_pelanggans.noHP')
                      ->where('data_pelanggans.kode', $searchKodePelanggan);
            })
            // Mengurutkan berdasarkan created_at dari tabel reservasis
            ->orderBy('reservasis.created_at', 'desc');
        
        // Dapatkan hasil paginasi
        $reservasis = $reservasiQuery->paginate(10);
    
        // Dapatkan semua jenis kerusakan untuk dropdown filter
        $jenisKerusakan = JenisKerusakan::all();
    
        return view('admin.reservasi.done', compact('reservasis', 'jenisKerusakan'));
    }


    // Menampilkan form untuk menambahkan reservasi baru
    public function create()
    {
        $jenisKerusakan = JenisKerusakan::all(); // Ambil data jenis kerusakan

        return view('admin.reservasi.create', compact('jenisKerusakan'));
    }

    // Menyimpan reservasi baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'alamatLengkap' => 'required|string',
            'noTelp' => 'required|string|max:15',
            'idJenisKerusakan' => 'required|exists:jenis_kerusakans,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|string',
            'video' => 'nullable|string',
            'noResi' => 'required|unique:reservasis',
            'servis' => 'required|string',
            'status' => 'nullable|string|in:pending,confirmed,process,completed,cancelled',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
    
        // Cek apakah pelanggan sudah ada berdasarkan noTelp
        $pelanggan = DataPelanggan::where('noHP', $request->noTelp)->first();
    
        // Jika pelanggan tidak ada, buat pelanggan baru
        if (!$pelanggan) {
            $pelanggan = DataPelanggan::create([
                'nama' => $request->namaLengkap,
                'noHP' => $request->noTelp,
                'alamat' => $request->alamatLengkap,
            ]);
        } else {
            // Jika pelanggan sudah ada, Anda bisa memperbarui data jika perlu
            $pelanggan->update([
                'nama' => $request->namaLengkap,
                'noHP' => $request->noTelp,
                'alamat' => $request->alamatLengkap,
            ]);
        }
    
        // Ambil longlat bengkel dari settings
        $bengkelLonglat = Setting::where('key', 'bengkel_longlat')->first();
        $tarifPerKm = Setting::where('key', 'tarif_per_km')->first();
        $biayaPerKm = $tarifPerKm ? (int)$tarifPerKm->value : 5000; // default 5000
        $biayaPerjalanan = 0;
        if ($bengkelLonglat) {
            [$bengkelLong, $bengkelLat] = explode(',', $bengkelLonglat->value);
            $jarak = $this->haversineDistance($request->latitude, $request->longitude, $bengkelLat, $bengkelLong);
            $biayaPerjalanan = ceil($jarak) * $biayaPerKm;
        }
    
        // Simpan data reservasi
        $reservasi = Reservasi::create(array_merge($validatedData, [
            'idPelanggan' => $pelanggan->id,
            'biaya_perjalanan' => $biayaPerjalanan,
        ]));
    
        // Simpan riwayat hanya jika status diberikan
        if (!is_null($reservasi->status)) {
            Riwayat::create([
                'idReservasi' => $reservasi->id,
                'status' => $reservasi->status,
            ]);
        }
    
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil ditambahkan.');
    }


    // Fungsi untuk menghitung jarak Haversine (km)
    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;
        return $distance;
    }

    // Menampilkan form untuk mengedit reservasi
    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $jenisKerusakan = JenisKerusakan::all();

        return view('admin.reservasi.edit', compact('reservasi', 'jenisKerusakan'));
    }

    // Memperbarui reservasi
    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $validatedData = $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'alamatLengkap' => 'required|string',
            'noTelp' => 'required|string|max:15',
            'idJenisKerusakan' => 'required|exists:jenis_kerusakans,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|string',
            'video' => 'nullable|string',
            'noResi' => 'nullable|unique:reservasis,noResi,' . $reservasi->id,
            'servis' => 'required|string',
            'status' => 'nullable|string|in:pending,confirmed,process,completed,cancelled',
        ]);

        // Update data reservasi
        $reservasi->update($validatedData);

        // Simpan riwayat hanya jika status diberikan dalam validatedData
        if (isset($validatedData['status']) && !is_null($validatedData['status'])) {
            Riwayat::create([
                'idReservasi' => $reservasi->id,
                'status' => $validatedData['status'],
            ]);
        }

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
    
        // Hapus data terkait di req_jadwals
        $reservasi->reqJadwals()->delete();
        
        // Hapus data terkait di jadwals
        $reservasi->jadwals()->delete();
        
        // Hapus data terkait di riwayats
        $reservasi->riwayats()->delete();
    
        // Hapus data di reservasi
        $reservasi->delete();
    
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }

    // Menampilkan detail reservasi dan riwayatnya
    public function show($id)
    {
        // Mengambil data reservasi berdasarkan ID, beserta jenis kerusakan dan riwayat
        $reservasi = Reservasi::with(['jenisKerusakan', 'teknisi'])->findOrFail($id);
        $riwayats = Riwayat::where('idReservasi', $id)->get(); // Mengambil data riwayat terkait
        
        return view('admin.reservasi.show', compact('reservasi', 'riwayats'));
    }

    // Fungsi untuk mengubah status reservasi
    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
    
        // Validasi input status
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending,confirmed,process,completed,cancelled',
        ]);
    
        if ($validatedData['status'] == 'confirmed') {
            // Redirect ke halaman tambah jadwal dengan idReservasi disertakan
            return redirect()->route('jadwal.create', ['idReservasi' => $reservasi->id]);
        }
    
         // Jika status berubah menjadi 'completed', hapus semua jadwal terkait
        if ($validatedData['status'] == 'completed') {
            // Cek apakah ada jadwal terkait dan hapus semuanya
            $jadwals = $reservasi->jadwals; // Menggunakan relasi hasMany
            if ($jadwals->isNotEmpty()) {
                foreach ($jadwals as $jadwal) {
                    $jadwal->delete(); // Menghapus setiap jadwal terkait
                }
            }
            $reqJadwals = $reservasi->reqJadwals;
            if ($reqJadwals->isNotEmpty()) {
                foreach ($reqJadwals as $reqJadwal) {
                    $reqJadwal->delete(); // Menghapus setiap reqJadwal terkait
                }
            }
        }

        // Update status reservasi dan id_user jika status adalah 'process' atau 'completed'
        $updateData = ['status' => $validatedData['status']];
        
        // Jika status adalah 'process' atau 'completed', isi id_user dengan user yang sedang login
        if (in_array($validatedData['status'], ['process', 'completed'])) {
            $updateData['id_user'] = auth()->id();
        }
        
        $reservasi->update($updateData);
    
        // Simpan perubahan status ke riwayat
        Riwayat::create([
            'idReservasi' => $reservasi->id,
            'status' => $reservasi->status,
        ]);
    
        return redirect()->route('admin.reservasi.index')->with('success', 'Status reservasi berhasil diperbarui.');
    }

}