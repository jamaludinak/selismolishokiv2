@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Edit Jadwal</h2>

    <form action="{{ route('jadwal.update', $jadwaledit->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="flex flex-col mb-4">
            <label for="idReservasi" class="mb-2 text-gray-700 font-semibold">Reservasi:</label>
            <select name="idReservasi" id="idReservasi" class="border rounded-lg p-2" required>
                @foreach ($reservasis as $reservasi)
                    <option value="{{ $reservasi->id }}" {{ $reservasi->id == $jadwaledit->idReservasi ? 'selected' : '' }}>
                        {{ $reservasi->namaLengkap }} ({{ $reservasi->noResi }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col mb-4">
            <label for="tanggal" class="mb-2 text-gray-700 font-semibold">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" class="border rounded-lg p-2" value="{{ $jadwaledit->tanggal }}" required>
        </div>

        <div class="flex flex-col mb-4">
            <label for="waktuMulai" class="mb-2 text-gray-700 font-semibold">Waktu Mulai:</label>
            <select name="waktuMulai" id="waktuMulai" class="border rounded-lg p-2" required>
                @for ($i = 8; $i <= 20; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ $jadwaledit->waktuMulai == str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' ? 'selected' : '' }}>
                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                    </option>
                @endfor
            </select>
        </div>

        <div class="flex flex-col mb-4">
            <label for="waktuSelesai" class="mb-2 text-gray-700 font-semibold">Waktu Selesai:</label>
            <select name="waktuSelesai" id="waktuSelesai" class="border rounded-lg p-2" required>
                @for ($i = 9; $i <= 21; $i++)
                    <option value="{{ str_pad($i-1, 2, '0', STR_PAD_LEFT) }}:59" {{ $jadwaledit->waktuSelesai == str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' ? 'selected' : '' }}>
                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                    </option>
                @endfor
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition duration-200">
                Update Jadwal
            </button>
        </div>
    </form>
</div>
@endsection
