<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeknisiController extends Controller
{
    public function index()
    {
        // Get confirmed and process reservations with their schedules
        $reservasis = Reservasi::with(['jadwals', 'jenisKerusakan', 'kendaraan', 'teknisi'])
            ->whereIn('status', ['confirmed', 'process'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.teknisi.index', compact('reservasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:process,completed',
            'total_harga' => 'required_if:status,completed|numeric|min:0',
            'tanggal_berakhir_garansi' => 'nullable|date|after:today',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        
        $updateData = [
            'status' => $request->status,
            'id_user' => Auth::id() // Otomatis isi dengan user yang sedang login
        ];

        // If status is completed, add total_harga and optional warranty end date
        if ($request->status === 'completed') {
            $updateData['total_harga'] = $request->total_harga;
            
            if ($request->tanggal_berakhir_garansi) {
                $updateData['tanggal_berakhir_garansi'] = $request->tanggal_berakhir_garansi;
            } else {
                // Set default warranty end date (30 days from today)
                $updateData['tanggal_berakhir_garansi'] = Carbon::now()->addDays(30)->format('Y-m-d');
            }
        }

        $reservasi->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Status reservasi berhasil diperbarui',
            'reservasi' => $reservasi->load(['jadwals', 'jenisKerusakan', 'kendaraan'])
        ]);
    }

    public function getReservasiDetail($id)
    {
        $reservasi = Reservasi::with(['jadwals', 'jenisKerusakan', 'kendaraan'])
            ->findOrFail($id);

        return response()->json($reservasi);
    }
}
