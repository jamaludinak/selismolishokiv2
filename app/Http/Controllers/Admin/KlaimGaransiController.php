<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KlaimGaransi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlaimGaransiController extends Controller
{
    public function index(Request $request)
    {
        $query = KlaimGaransi::with(['reservasi', 'dataPelanggan']);
        
        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by no resi
        if ($request->filled('search_no_resi')) {
            $query->whereHas('reservasi', function($q) use ($request) {
                $q->where('noResi', 'like', '%' . $request->search_no_resi . '%');
            });
        }

        // Search by pelanggan name
        if ($request->filled('search_pelanggan')) {
            $query->whereHas('dataPelanggan', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search_pelanggan . '%');
            })->orWhereHas('reservasi', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search_pelanggan . '%');
            });
        }
        
        $klaimGaransis = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.klaim_garansi.index', compact('klaimGaransis'));
    }

    public function show($id)
    {
        $klaimGaransi = KlaimGaransi::with(['reservasi', 'dataPelanggan'])->findOrFail($id);
        return view('admin.klaim_garansi.show', compact('klaimGaransi'));
    }

    public function approve(Request $request, $id)
    {
        $klaimGaransi = KlaimGaransi::findOrFail($id);
        
        $klaimGaransi->update([
            'status' => 'diterima',
            'tanggal_diproses' => now()
        ]);

        return redirect()->route('admin.klaim-garansi.index')
            ->with('success', 'Klaim garansi berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $klaimGaransi = KlaimGaransi::findOrFail($id);
        
        $klaimGaransi->update([
            'status' => 'ditolak',
            'tanggal_diproses' => now()
        ]);

        return redirect()->route('admin.klaim-garansi.index')
            ->with('success', 'Klaim garansi telah ditolak.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $klaimGaransi = KlaimGaransi::findOrFail($id);
        
        $updateData = [
            'status' => $request->status
        ];

        if (in_array($request->status, ['diterima', 'ditolak'])) {
            $updateData['tanggal_diproses'] = now();
        }

        $klaimGaransi->update($updateData);

        return redirect()->route('admin.klaim-garansi.index')
            ->with('success', 'Status klaim garansi berhasil diperbarui.');
    }
}
