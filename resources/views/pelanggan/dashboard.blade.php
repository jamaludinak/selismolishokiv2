@extends('pelanggan.layouts.app')
@section('title', 'Dashboard Pelanggan')
@section('content')

    <div class="grid grid-cols-2 p-4 md:grid-cols-3 gap-4 mb-6">
        <!-- Reservasi Servis -->
        <a href="{{ route('reservasi.create') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">➕</div>
            <div class="font-semibold text-sm mt-2">Reservasi</div>
        </a>

        <!-- Alamat -->
        <a href="{{ route('alamat.create') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">🏠</div>
            <div class="font-semibold text-sm mt-2">Alamat</div>
        </a>

        <!-- Kendaraan -->
        <a href="{{ route('kendaraan.create') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">🏍️</div>
            <div class="font-semibold text-sm mt-2">Kendaraan</div>
        </a>
    </div>

@endsection
