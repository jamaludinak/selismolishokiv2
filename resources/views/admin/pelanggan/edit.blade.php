@extends('layouts.admin')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Edit Pelanggan</h1>
        <a href="{{ route('pelanggan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-300 transition duration-300 ease-in-out">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Terjadi kesalahan:</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('pelanggan.update', $dataPelanggan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="kode" class="block text-sm font-medium text-gray-700">Kode Pelanggan</label>
                <input type="text" name="kode" id="kode"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed sm:text-sm"
                       value="{{ old('kode', $dataPelanggan->kode) }}" readonly>
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" id="nama"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                       value="{{ old('nama', $dataPelanggan->nama) }}" required>
            </div>

            <div>
                <label for="noHP" class="block text-sm font-medium text-gray-700">Nomor Telepon (HP)</label>
                <input type="text" name="noHP" id="noHP"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                       value="{{ old('noHP', $dataPelanggan->noHP) }}" required>
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                          required>{{ old('alamat', $dataPelanggan->alamat) }}</textarea>
            </div>
            
            <div>
                <label for="keluhan" class="block text-sm font-medium text-gray-700">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="3"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                          placeholder="Masukkan keluhan pelanggan (opsional)">{{ old('keluhan', $dataPelanggan->keluhan) }}</textarea>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Perbarui Pelanggan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection