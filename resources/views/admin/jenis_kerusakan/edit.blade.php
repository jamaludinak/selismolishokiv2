@extends('layouts.admin')

@section('title', 'Edit Jenis Kerusakan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Edit Jenis Kerusakan</h1>
        <a href="{{ route('jenis_kerusakan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-300 transition duration-300 ease-in-out">
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
        <form action="{{ route('jenis_kerusakan.update', $jenisKerusakan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Jenis Kerusakan</label>
                <input type="text" name="nama" id="nama"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                       value="{{ old('nama', $jenisKerusakan->nama) }}" required>
            </div>

            <div>
                <label for="biaya_estimasi" class="block text-sm font-medium text-gray-700">Estimasi Biaya (Rp)</label>
                <input type="number" name="biaya_estimasi" id="biaya_estimasi"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                       placeholder="Contoh: 50000 (kosongkan jika belum ada)" value="{{ old('biaya_estimasi', $jenisKerusakan->biaya_estimasi) }}" step="0.01">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection