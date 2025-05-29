<!-- resources/views/admin/reservasi/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Reservasi Baru</h1>

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

    <form action="{{ route('reservasi.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="namaLengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="namaLengkap" id="namaLengkap" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" value="{{ old('namaLengkap') }}" required>
            </div>

            <div>
                <label for="noTelp" class="block text-sm font-medium text-gray-700">No Telp</label>
                <input type="text" name="noTelp" id="noTelp" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" value="{{ old('noTelp') }}" required>
            </div>
        </div>

        <div class="mb-4">
            <label for="alamatLengkap" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
            <textarea name="alamatLengkap" id="alamatLengkap" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" required>{{ old('alamatLengkap') }}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="idJenisKerusakan" class="block text-sm font-medium text-gray-700">Jenis Kerusakan</label>
                <select name="idJenisKerusakan" id="idJenisKerusakan" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" required>
                    <option value="" disabled selected>Pilih jenis kerusakan</option>
                    @foreach($jenisKerusakan as $jenis)
                        <option value="{{ $jenis->id }}" {{ old('idJenisKerusakan') == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="servis" class="block text-sm font-medium text-gray-700">Jenis Servis</label>
                <select name="servis" id="servis" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" required>
                    <option value="" disabled selected>Pilih jenis servis</option>
                    <option value="Home" {{ old('servis') == 'Home' ? 'selected' : '' }}>Home Service</option>
                    <option value="Garage" {{ old('servis') == 'Garage' ? 'selected' : '' }}>Garage Service</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="noResi" class="block text-sm font-medium text-gray-700">No Resi</label>
            <input type="text" name="noResi" id="noResi" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" value="{{ old('noResi') }}" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
