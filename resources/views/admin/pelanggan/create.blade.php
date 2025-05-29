<!-- resources/views/admin/pelanggan/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Data Pelanggan Baru</h1>
    <a href="{{ route('pelanggan.index') }}" class="inline-block mb-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600">Kembali</a>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada kesalahan dalam input data.</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="namaLengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" id="namaLengkap" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" value="{{ old('nama') }}" required>
            </div>

            <div>
                <label for="noTelp" class="block text-sm font-medium text-gray-700">No Telp</label>
                <input type="text" name="noHP" id="noTelp" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" value="{{ old('noHP') }}" required>
            </div>
        </div>

        <div class="mb-4">
            <label for="alamatLengkap" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
            <textarea name="alamat" id="alamatLengkap" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" required>{{ old('alamat') }}</textarea>
        </div>
        
        <div class="mb-4">
            <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg">{{ old('keluhan') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
