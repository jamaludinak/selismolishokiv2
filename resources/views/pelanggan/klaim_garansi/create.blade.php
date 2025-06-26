@extends('pelanggan.layouts.app')
@section('title', 'Ajukan Klaim Garansi')

@section('content')
    <div class="max-w-xl mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Ajukan Klaim Garansi</h2>

        <div class="mb-4 p-4 bg-gray-100 rounded text-sm">
            <p><strong>No. Resi:</strong> {{ $reservasi->noResi }}</p>
            <p><strong>Kode Kendaraan:</strong> {{ $reservasi->kendaraan->kode ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($reservasi->status) }}</p>
            <p><strong>Garansi Berakhir:</strong>
                {{ \Carbon\Carbon::parse($reservasi->tanggal_berakhir_garansi)->format('d-m-Y') }}</p>
        </div>

        <form method="POST" action="{{ route('klaim-garansi.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">

            <div class="mb-4">
                <label class="block mb-1 font-medium">Upload Foto Bukti</label>
                <input type="file" name="bukti" required class="w-full border p-2 rounded">
                @error('bukti')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Keterangan (Opsional)</label>
                <textarea name="keterangan" rows="3" class="w-full border p-2 rounded"></textarea>
                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">
                Kirim Klaim
            </button>
        </form>
    </div>
@endsection
