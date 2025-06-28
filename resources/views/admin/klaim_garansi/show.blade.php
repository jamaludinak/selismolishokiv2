@extends('layouts.admin')

@section('title', 'Detail Klaim Garansi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Detail Klaim Garansi</h1>
    <a href="{{ route('admin.klaim-garansi.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Detail Klaim -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-orange-600 text-white px-6 py-4">
            <h3 class="text-lg font-semibold">Informasi Klaim</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    @if($klaimGaransi->status == 'diajukan')
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Diajukan
                        </span>
                    @elseif($klaimGaransi->status == 'diterima')
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Diterima
                        </span>
                    @else
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Ditolak
                        </span>
                    @endif
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
                
                @if($klaimGaransi->tanggal_diproses)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Diproses</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->tanggal_diproses->format('d/m/Y H:i:s') }}</p>
                </div>
                @endif
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->keterangan ?: 'Tidak ada keterangan' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Bukti Foto</label>
                    @if($klaimGaransi->bukti)
                        <img src="{{ asset('storage/' . $klaimGaransi->bukti) }}" 
                             alt="Bukti Klaim" 
                             class="mt-2 max-w-full h-auto rounded-lg border border-gray-300"
                             style="max-height: 400px;">
                    @else
                        <p class="mt-1 text-sm text-gray-500">Tidak ada bukti foto</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Reservasi -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-orange-600 text-white px-6 py-4">
            <h3 class="text-lg font-semibold">Informasi Reservasi</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Resi</label>
                    <p class="mt-1 text-sm text-gray-900 font-mono">{{ $klaimGaransi->reservasi->noResi ?? '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->dataPelanggan->nama ?? $klaimGaransi->reservasi->nama ?? '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->reservasi->noTelp ?? '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Servis</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->reservasi->jenis_servis ?? '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Servis</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $klaimGaransi->reservasi->tanggal_servis ? date('d/m/Y', strtotime($klaimGaransi->reservasi->tanggal_servis)) : '-' }}</p>
                </div>
                
                @if($klaimGaransi->reservasi->tanggal_berakhir_garansi)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Berakhir Garansi</label>
                    <p class="mt-1 text-sm text-gray-900">{{ date('d/m/Y', strtotime($klaimGaransi->reservasi->tanggal_berakhir_garansi)) }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
@if($klaimGaransi->status == 'diajukan')
<div class="mt-6 bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
    <div class="flex space-x-4">
        <form action="{{ route('admin.klaim-garansi.approve', $klaimGaransi->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" 
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200"
                    onclick="return confirm('Yakin ingin menyetujui klaim garansi ini?')">
                <i class="fas fa-check mr-2"></i>Setujui Klaim
            </button>
        </form>
        
        <form action="{{ route('admin.klaim-garansi.reject', $klaimGaransi->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" 
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-200"
                    onclick="return confirm('Yakin ingin menolak klaim garansi ini?')">
                <i class="fas fa-times mr-2"></i>Tolak Klaim
            </button>
        </form>
    </div>
</div>
@endif
@endsection 