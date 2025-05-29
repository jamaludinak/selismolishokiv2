@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Back Button at the Top Left -->
    <div class="flex justify-start mb-6">
        <a href="{{ route('jadwal.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition duration-200">
            ← Kembali
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-6">Tambah Jadwal</h2>

    <!-- Jadwal Form -->
    <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Hidden field for idReservasi -->
        <input type="hidden" name="idReservasi" value="{{ $idReservasi }}">

        <!-- Tanggal Field -->
        <div class="flex flex-col">
            <label for="tanggal" class="mb-2 text-gray-700 font-semibold">Tanggal:</label>
            <input type="date" name="tanggal" class="border rounded-lg p-2" required>
        </div>

        <!-- Waktu Mulai Field -->
        <div class="flex flex-col">
            <label for="waktuMulai" class="mb-2 text-gray-700 font-semibold">Waktu Mulai:</label>
            <div class="flex items-center">
                <select name="waktuMulai" class="border rounded-lg p-2 mr-2" required>
                    @for ($i = 8; $i <= 20; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Waktu Selesai Field -->
        <div class="flex flex-col">
            <label for="waktuSelesai" class="mb-2 text-gray-700 font-semibold">Waktu Selesai:</label>
            <div class="flex items-center">
                <select name="waktuSelesai" class="border rounded-lg p-2 mr-2" required>
                    @for ($i = 9; $i <= 21; $i++)
                        <option value="{{ str_pad($i-1, 2, '0', STR_PAD_LEFT) }}:59">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition duration-200">
                Buat Jadwal
            </button>
        </div>
    </form>
</div>
@endsection
