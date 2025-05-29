@extends('layouts.admin')

@section('title', 'Detail Reservasi')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Detail Reservasi</h2>
    
    <a href="{{ route('reservasi.index') }}" class="inline-block mb-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600">Kembali</a>

    <div class="bg-white shadow-lg rounded-lg p-4">
        <h3 class="text-lg font-bold mb-2">Informasi Reservasi</h3>
        <table class="min-w-full table-auto border border-gray-200">
            <tbody>
                <tr>
                    <td class="px-4 py-2 border font-semibold">No Resi</td>
                    <td class="px-4 py-2 border">{{ $reservasi->noResi }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-semibold">Status</td>
                    <td class="px-4 py-2 border">{{ ucfirst($reservasi->status) }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-semibold">Nama</td>
                    <td class="px-4 py-2 border">{{ $reservasi->namaLengkap }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-semibold">No Telp</td>
                    <td class="px-4 py-2 border">{{ $reservasi->noTelp }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-semibold">Alamat</td>
                    <td class="px-4 py-2 border">{{ $reservasi->alamatLengkap }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-semibold">Jenis Servis</td>
                    <td class="px-4 py-2 border">{{ $reservasi->servis }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border font-semibold">Jenis Kerusakan</td>
                    <td class="px-4 py-2 border">{{ $reservasi->jenisKerusakan->nama ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Deskripsi sebagai paragraf -->
    <div class="bg-white shadow-lg rounded-lg p-4 mt-4" style="margin-bottom: 1rem;">
        <h3 class="text-lg font-bold mb-2">Deskripsi</h3>
        <p>{{ $reservasi->deskripsi }}</p>
    </div>
    
    <!-- Display Gambar -->
    @if($reservasi->gambar)
    <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem; max-width: 600px; margin: auto; margin-bottom: 1rem;">
        <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem;">Gambar Kerusakan</h3>
        <img src="{{ url('storage/' . $reservasi->gambar) }}" alt="Gambar Kerusakan" style="width: 100%; height: auto; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); transition: transform 0.3s; cursor: pointer;">
    </div>
    @else
    <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem; margin-bottom: 1rem;">
        <p>Gambar tidak tersedia.</p>
    </div>
    @endif
    
    <!-- Display Video -->
    @if($reservasi->video)
    <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem; max-width: 600px; margin: auto;">
        <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem;">Video Kerusakan</h3>
        <video controls style="width: 100%; height: auto; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <source src="{{ url('storage/' . $reservasi->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    @else
    <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1rem; margin-top: 1rem;">
        <p>Video tidak tersedia.</p>
    </div>
    @endif

    <!-- Riwayat Status dengan Format Waktu Indonesia -->
    <h3 class="text-lg font-bold mt-4 mb-2">Riwayat Status</h3>
    <div class="bg-white shadow-lg rounded-lg p-4">
        @if($riwayats->isEmpty())
            <p>Tidak ada riwayat status untuk reservasi ini.</p>
        @else
            <table class="min-w-full table-auto border border-gray-200">
                <thead>
                    <tr class="bg-orange-500 text-white">
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayats as $riwayat)
                    <tr class="hover:bg-gray-100">
                        <!-- Menggunakan Carbon untuk format tanggal dan waktu Indonesia -->
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($riwayat->created_at)->locale('id')->timezone('Asia/Jakarta')->translatedFormat('d F Y - H:i:s') }}</td>
                        <td class="px-4 py-2 border">
                            <span class="inline-block py-1 px-2 rounded text-xs font-semibold 
                                {{ $riwayat->status == 'completed' ? 'bg-green-200 text-green-800' : 
                                   ($riwayat->status == 'cancelled' ? 'bg-red-200 text-red-800' : 
                                   ($riwayat->status == 'process' ? 'bg-yellow-200 text-yellow-800' : 
                                   'bg-blue-200 text-blue-800')) }}">
                                {{ ucfirst($riwayat->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>


</div>
@endsection
