@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Data Pelanggan</h1>
    <a href="{{ route('pelanggan.index') }}" class="inline-block mb-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600">Kembali</a>

    <form action="{{ route('pelanggan.update', $dataPelanggan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama" class="block font-semibold mb-2">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="w-full border p-2 rounded-lg" value="{{ $dataPelanggan->nama }}" required>
        </div>
        
        <div class="form-group">
            <label for="noHP" class="block font-semibold mb-2">Nomor Telepon</label>
            <input type="text" name="noHP" id="noHP" class="w-full border p-2 rounded-lg" value="{{ $dataPelanggan->noHP }}" required>
        </div>
        
        <div class="form-group">
            <label for="alamat" class="block font-semibold mb-2">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" class="w-full border p-2 rounded-lg" required>{{ $dataPelanggan->alamat }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="keluhan" class="block font-semibold mb-2">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="w-full border p-2 rounded-lg">{{ $dataPelanggan->keluhan }}</textarea>
        </div>

        <button type="submit" class="bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-yellow-600">Perbarui Data Pelanggan</button>
    </form>
</div>
@endsection
