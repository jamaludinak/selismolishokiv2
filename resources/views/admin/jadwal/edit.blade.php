@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-50 py-8">
    <!-- Header Card -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-calendar-check mr-3 text-4xl"></i>
                            Edit Jadwal
                        </h1>
                        <p class="text-orange-100 mt-2">Perbarui jadwal servis pelanggan</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('jadwal.index') }}"
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Form Edit Jadwal
                </h3>
            </div>
            <form action="{{ route('jadwal.update', $jadwaledit->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="idReservasi" class="text-sm font-medium text-gray-600 block mb-2">
                        <i class="fas fa-users mr-2 text-orange-500"></i>Reservasi
                    </label>
                    <select name="idReservasi" id="idReservasi"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
                            required>
                        @foreach ($reservasis as $reservasi)
                            <option value="{{ $reservasi->id }}" {{ old('idReservasi', $jadwaledit->idReservasi) == $reservasi->id ? 'selected' : '' }}>
                                {{ $reservasi->namaLengkap }} ({{ $reservasi->noResi }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tanggal" class="text-sm font-medium text-gray-600 block mb-2">
                        <i class="fas fa-calendar-alt mr-2 text-orange-500"></i>Tanggal
                    </label>
                    <input type="date" name="tanggal" id="tanggal"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
                           value="{{ old('tanggal', $jadwaledit->tanggal) }}" required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="waktuMulai" class="text-sm font-medium text-gray-600 block mb-2">
                            <i class="fas fa-clock mr-2 text-orange-500"></i>Waktu Mulai
                        </label>
                        <select name="waktuMulai" id="waktuMulai"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
                                required>
                            @for ($i = 8; $i <= 20; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00" {{ old('waktuMulai', \Carbon\Carbon::parse($jadwaledit->waktuMulai)->format('H:i')) == str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' ? 'selected' : '' }}>
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="waktuSelesai" class="text-sm font-medium text-gray-600 block mb-2">
                            <i class="fas fa-clock mr-2 text-orange-500"></i>Waktu Selesai
                        </label>
                        <select name="waktuSelesai" id="waktuSelesai"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
                                required>
                            @for ($i = 9; $i <= 21; $i++)
                                <option value="{{ str_pad($i-1, 2, '0', STR_PAD_LEFT) }}:59" {{ old('waktuSelesai', \Carbon\Carbon::parse($jadwaledit->waktuSelesai)->format('H:i')) == str_pad($i-1, 2, '0', STR_PAD_LEFT) . ':59' ? 'selected' : '' }}>
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                        <i class="fas fa-calendar-check mr-2 group-hover:scale-110 transition-transform"></i>
                        Perbarui Jadwal
                    </button>
                    <a href="{{ route('jadwal.index') }}"
                       class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                        <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Help Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mt-8">
            <div class="text-center">
                <i class="fas fa-info-circle text-3xl mb-3 text-gray-600"></i>
                <h3 class="text-lg font-semibold mb-2 text-black">Tips Pengisian Data</h3>
                <div class="text-gray-700 text-sm space-y-1">
                    <p>• Pilih reservasi yang sesuai.</p>
                    <p>• Tentukan tanggal dan waktu servis dengan benar.</p>
                    <p>• Pastikan tidak ada jadwal bentrok.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection