@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Edit Jadwal</h1>
        <a href="{{ route('jadwal.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-300 transition duration-300 ease-in-out">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

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
        <form action="{{ route('jadwal.update', $jadwaledit->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="idReservasi" class="block text-sm font-medium text-gray-700">Reservasi</label>
                <select name="idReservasi" id="idReservasi"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
                    @foreach ($reservasis as $reservasi)
                        <option value="{{ $reservasi->id }}" {{ old('idReservasi', $jadwaledit->idReservasi) == $reservasi->id ? 'selected' : '' }}>
                            {{ $reservasi->namaLengkap }} ({{ $reservasi->noResi }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                       value="{{ old('tanggal', $jadwaledit->tanggal) }}" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="waktuMulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                    <select name="waktuMulai" id="waktuMulai"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
                        @for ($i = 8; $i <= 20; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ old('waktuMulai', \Carbon\Carbon::parse($jadwaledit->waktuMulai)->format('H:i')) == str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' ? 'selected' : '' }}>
                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="waktuSelesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                    <select name="waktuSelesai" id="waktuSelesai"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm" required>
                        @for ($i = 9; $i <= 21; $i++)
                            <option value="{{ str_pad($i-1, 2, '0', STR_PAD_LEFT) }}:59" {{ old('waktuSelesai', \Carbon\Carbon::parse($jadwaledit->waktuSelesai)->format('H:i')) == str_pad($i-1, 2, '0', STR_PAD_LEFT) . ':59' ? 'selected' : '' }}>
                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-calendar-check mr-2"></i> Perbarui Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection