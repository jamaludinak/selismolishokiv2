@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h2 class="text-2xl font-bold mb-4">Dashboard Utama</h2>

<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold">Total Reservasi</h3>
        <p class="text-2xl font-bold text-orange-500">{{ $totalReservasi }}</p>
    </div>
    
        <!-- New Section for Total Pelanggan -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold">Total Pelanggan</h3>
        <p class="text-2xl font-bold text-purple-500">{{ $totalPelanggan }}</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold">Home Service Reservasi</h3>
        <p class="text-2xl font-bold text-green-500">{{ $homeServiceReservasi }}</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold">Reservasi di Bengkel</h3>
        <p class="text-2xl font-bold text-blue-500">{{ $bengkelReservasi }}</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold">Rata-rata Rating</h3>
        <p class="text-2xl font-bold text-yellow-500">{{ number_format($averageRating, 1) }}</p>
    </div>

</div>

<form action="{{ route('logout') }}" method="POST" class="mt-8">
    @csrf
    <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition">
        Logout
    </button>
</form>

@endsection
