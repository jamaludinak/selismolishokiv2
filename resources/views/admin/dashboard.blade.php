@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h2 class="text-3xl font-bold mb-8 text-gray-800 border-b-2 border-orange-500 pb-3">Selamat Datang, {{ Auth::user()->name }} !</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
    {{-- Card Total Reservasi --}}
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200 transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Reservasi</h3>
            <p class="text-5xl font-extrabold text-orange-600">{{ $totalReservasi }}</p>
        </div>
        <div class="text-orange-500 text-6xl opacity-75">
            <i class="fas fa-clipboard-list"></i> {{-- Icon for Total Reservations --}}
        </div>
    </div>

    {{-- Card Total Pelanggan --}}
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200 transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Pelanggan</h3>
            <p class="text-5xl font-extrabold text-purple-600">{{ $totalPelanggan }}</p>
        </div>
        <div class="text-purple-500 text-6xl opacity-75">
            <i class="fas fa-users"></i> {{-- Icon for Total Customers --}}
        </div>
    </div>

    {{-- Card Home Service Reservasi --}}
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200 transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Home Service</h3>
            <p class="text-5xl font-extrabold text-green-600">{{ $homeServiceReservasi }}</p>
        </div>
        <div class="text-green-500 text-6xl opacity-75">
            <i class="fas fa-home"></i> {{-- Icon for Home Service --}}
        </div>
    </div>

    {{-- Card Reservasi di Bengkel --}}
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200 transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Servis Bengkel</h3>
            <p class="text-5xl font-extrabold text-blue-600">{{ $bengkelReservasi }}</p>
        </div>
        <div class="text-blue-500 text-6xl opacity-75">
            <i class="fas fa-wrench"></i> {{-- Icon for Workshop Service --}}
        </div>
    </div>

    {{-- Card Rata-rata Rating --}}
    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200 transform hover:scale-105 transition duration-300 ease-in-out flex items-center justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Rata-rata Rating</h3>
            <p class="text-5xl font-extrabold text-yellow-600">{{ number_format($averageRating, 1) }} <span class="text-3xl text-gray-500">/ 5</span></p>
        </div>
        <div class="text-yellow-500 text-6xl opacity-75">
            <i class="fas fa-star-half-alt"></i> {{-- Icon for Average Rating --}}
        </div>
    </div>
</div>

@endsection