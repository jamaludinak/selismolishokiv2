@extends('layouts.admin')

@section('title', 'Edit Reservasi')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Edit Reservasi</h1>
        <a href="{{ route('reservasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-300 transition duration-300 ease-in-out">
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
        <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="namaLengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="namaLengkap" id="namaLengkap" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" value="{{ old('namaLengkap', $reservasi->namaLengkap) }}" required>
                </div>

                <div>
                    <label for="noTelp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="noTelp" id="noTelp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" value="{{ old('noTelp', $reservasi->noTelp) }}" required>
                </div>
            </div>

            <div>
                <label for="alamatLengkap" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                <textarea name="alamatLengkap" id="alamatLengkap" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>{{ old('alamatLengkap', $reservasi->alamatLengkap) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="idJenisKerusakan" class="block text-sm font-medium text-gray-700">Jenis Kerusakan</label>
                    <select name="idJenisKerusakan" id="idJenisKerusakan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
                        <option value="">Pilih Jenis Kerusakan</option>
                        @foreach ($jenisKerusakan as $kerusakan)
                            <option value="{{ $kerusakan->id }}" {{ old('idJenisKerusakan', $reservasi->idJenisKerusakan) == $kerusakan->id ? 'selected' : '' }}>
                                {{ $kerusakan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="servis" class="block text-sm font-medium text-gray-700">Jenis Servis</label>
                    <select name="servis" id="servis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
                        <option value="Home Service" {{ old('servis', $reservasi->servis) == 'Home Service' ? 'selected' : '' }}>Home Service</option>
                        <option value="Garage Service" {{ old('servis', $reservasi->servis) == 'Garage Service' ? 'selected' : '' }}>Garage Service</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Kerusakan</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>{{ old('deskripsi', $reservasi->deskripsi) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i> Perbarui Reservasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection