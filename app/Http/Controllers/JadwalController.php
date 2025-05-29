<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Riwayat;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil minggu yang diminta atau minggu ini secara default
        $startOfWeek = $request->has('week') ? \Carbon\Carbon::parse($request->week)->startOfWeek() : \Carbon\Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->endOfWeek();

        // Ambil jadwal sesuai dengan range tanggal tersebut
        $jadwals = Jadwal::with('reservasi')
            ->whereBetween('tanggal', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
            ->get();

        return view('admin.jadwal.index', compact('jadwals', 'startOfWeek', 'endOfWeek'));
    }

    public function create(Request $request)
    {
        // Ambil idReservasi dari parameter jika tersedia
        $idReservasi = $request->idReservasi;

        // Ambil semua data reservasi
        $reservasis = Reservasi::all();

        // Kirimkan data ke view
        return view('admin.jadwal.create', compact('reservasis', 'idReservasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idReservasi' => 'required|exists:reservasis,id',
            'tanggal' => 'required|date',
            'waktuMulai' => 'required|date_format:H:i',
            'waktuSelesai' => 'required|date_format:H:i|before:nextHour', // Adjusted validation
        ]);
    
        // Cek apakah ada jadwal lain yang tumpang tindih
        $existingJadwal = Jadwal::where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktuMulai', [$request->waktuMulai, $request->waktuSelesai])
                    ->orWhereBetween('waktuSelesai', [$request->waktuMulai, $request->waktuSelesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('waktuMulai', '<=', $request->waktuMulai)
                                ->where('waktuSelesai', '>=', $request->waktuSelesai);
                    });
            })
            ->exists();
    
        if ($existingJadwal) {
            return redirect()->back()->withErrors(['error' => 'Jadwal bentrok dengan jadwal lain di waktu yang sama.'])->withInput();
        }
    
        // Simpan jadwal baru
        $jadwal = Jadwal::create($request->all());
    
        // Update status reservasi menjadi confirmed
        $reservasi = Reservasi::findOrFail($request->idReservasi);
        $reservasi->status = 'confirmed';
        $reservasi->save();
    
        // Simpan riwayat status menjadi confirmed
        Riwayat::create([
            'idReservasi' => $reservasi->id,
            'status' => 'confirmed',
        ]);
    
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan dan status reservasi menjadi confirmed.');
    }

    public function edit($id)
    {
        $jadwaledit = Jadwal::findOrFail($id);
        $jadwals = Jadwal::all();
        $reservasis = Reservasi::all(); 
        return view('admin.jadwal.edit', compact('jadwaledit', 'jadwals', 'reservasis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idReservasi' => 'required|exists:reservasis,id',
            'tanggal' => 'required|date',
            'waktuMulai' => 'required|date_format:H:i',
            'waktuSelesai' => 'required|date_format:H:i|before:nextHour', // Adjusted validation
        ]);
    
        // Cek apakah ada jadwal lain yang tumpang tindih (kecuali jadwal saat ini)
        $existingJadwal = Jadwal::where('tanggal', $request->tanggal)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktuMulai', [$request->waktuMulai, $request->waktuSelesai])
                    ->orWhereBetween('waktuSelesai', [$request->waktuMulai, $request->waktuSelesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('waktuMulai', '<=', $request->waktuMulai)
                                ->where('waktuSelesai', '>=', $request->waktuSelesai);
                    });
            })
            ->exists();
    
        if ($existingJadwal) {
            return redirect()->back()->withErrors(['error' => 'Jadwal bentrok dengan jadwal lain di waktu yang sama.'])->withInput();
        }
    
        // Update jadwal yang ada
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());
    
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }



}
