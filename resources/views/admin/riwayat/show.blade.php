@extends('layouts.admin')

@section('title', 'Detail Riwayat')

@section('content')
<div class="container mx-auto mt-10 p-4 sm:p-8 bg-white shadow-lg rounded-lg relative">
    <!-- Tombol Kembali -->
    <a href="{{ route('riwayat.index') }}" class="absolute top-4 left-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-200 ease-in-out">
        ← Kembali
    </a>

    <!-- Judul Halaman -->
    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center mt-12 sm:mt-0">Detail Riwayat</h2>

    <!-- Detail Riwayat -->
    <div class="space-y-4">
        <p><strong>ID:</strong> {{ $riwayat->id }}</p>
        <p><strong>Status:</strong> {{ $riwayat->status }}</p>
        <p><strong>Tanggal:</strong> {{ $riwayat->created_at }}</p>
    </div>
</div>
@endsection
