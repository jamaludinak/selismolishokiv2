@extends('pelanggan.layouts.app')
@section('title', 'Dashboard Pelanggan')
@section('content')

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
        <!-- Reservasi Servis -->
        <a href="{{ route('reservasi.create') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-50">
            <div class="text-2xl">➕</div>
            <div class="font-semibold text-sm mt-2">Reservasi</div>
        </a>

        <!-- Trade In -->
        <a href="{{ route('alamat.create') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-50">
            <div class="text-2xl">🏠</div>
            <div class="font-semibold text-sm mt-2">Alamat</div>
        </a>

        <!-- Claim Garansi -->
        <a href="{{ route('kendaraan.create') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-50">
            <div class="text-2xl">🏍️</div>
            <div class="font-semibold text-sm mt-2">Kendaraan</div>
        </a>

        <!-- Spare Parts -->
        {{-- <a href="#"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-50">
            <div class="text-2xl">🛒</div>
            <div class="font-semibold text-sm mt-2">spare parts</div>
        </a> --}}
    </div>

@endsection
