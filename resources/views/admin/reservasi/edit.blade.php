@extends('layouts.admin')

@section('title', 'Edit Reservasi')

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div
            class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-2">Edit Reservasi</h1>
                <p class="text-orange-100">Perbarui data reservasi pelanggan dengan mudah dan cepat</p>
            </div>
            <a href="{{ route('admin.reservasi.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 text-white font-semibold rounded-lg shadow-lg hover:bg-white hover:text-orange-600 transition duration-300 ease-in-out mt-4 sm:mt-0">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md"
                role="alert">
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
            <form action="{{ route('admin.reservasi.update', $reservasi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="namaLengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="namaLengkap" id="namaLengkap"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                            value="{{ old('namaLengkap', $reservasi->namaLengkap) }}" required>
                    </div>
                    <div>
                        <label for="noTelp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" name="noTelp" id="noTelp"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                            value="{{ old('noTelp', $reservasi->noTelp) }}" required>
                    </div>
                </div>

                <div>
                    <label for="alamatLengkap" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamatLengkap" id="alamatLengkap" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                        required>{{ old('alamatLengkap', $reservasi->alamatLengkap) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="idJenisKerusakan" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                            Kerusakan</label>
                        <select name="idJenisKerusakan" id="idJenisKerusakan"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                            required>
                            <option value="">Pilih Jenis Kerusakan</option>
                            @foreach ($jenisKerusakan as $kerusakan)
                                <option value="{{ $kerusakan->id }}"
                                    {{ old('idJenisKerusakan', $reservasi->idJenisKerusakan) == $kerusakan->id ? 'selected' : '' }}>
                                    {{ $kerusakan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="servis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Servis</label>
                        <select name="servis" id="servis"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                            required>
                            <option value="Home Service"
                                {{ old('servis', $reservasi->servis) == 'Home Service' ? 'selected' : '' }}>Home Service
                            </option>
                            <option value="Garage Service"
                                {{ old('servis', $reservasi->servis) == 'Garage Service' ? 'selected' : '' }}>Garage
                                Service</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="noResi" class="block text-sm font-medium text-gray-700 mb-1">No. Resi</label>
                        <input type="text" name="noResi" id="noResi"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                            value="{{ old('noResi', $reservasi->noResi) }}" placeholder="Contoh: HM-240528AA">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2">
                            <option value="">Pilih Status</option>
                            <option value="pending" {{ old('status', $reservasi->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="confirmed"
                                {{ old('status', $reservasi->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="process" {{ old('status', $reservasi->status) == 'process' ? 'selected' : '' }}>
                                Process</option>
                            <option value="completed"
                                {{ old('status', $reservasi->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled"
                                {{ old('status', $reservasi->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kerusakan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm p-2"
                        required>{{ old('deskripsi', $reservasi->deskripsi) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Perbarui Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
