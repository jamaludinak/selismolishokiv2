@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Pengaturan Sistem</h2>

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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Pengaturan Bengkel -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-building text-2xl text-orange-600 mr-3"></i>
                <h3 class="text-xl font-semibold text-gray-900">Pengaturan Bengkel</h3>
            </div>
            <p class="text-gray-600 mb-4">Kelola informasi lokasi dan pengaturan bengkel</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-md transition duration-300">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
        </div>

        <!-- Pengaturan Tarif -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-money-bill-wave text-2xl text-green-600 mr-3"></i>
                <h3 class="text-xl font-semibold text-gray-900">Pengaturan Tarif</h3>
            </div>
            <p class="text-gray-600 mb-4">Kelola tarif per kilometer dan biaya layanan</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-md transition duration-300">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
        </div>

        <!-- Pengaturan Sistem -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-cogs text-2xl text-blue-600 mr-3"></i>
                <h3 class="text-xl font-semibold text-gray-900">Pengaturan Sistem</h3>
            </div>
            <p class="text-gray-600 mb-4">Konfigurasi umum sistem dan aplikasi</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition duration-300">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
        </div>

        <!-- Backup & Restore -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-database text-2xl text-purple-600 mr-3"></i>
                <h3 class="text-xl font-semibold text-gray-900">Backup & Restore</h3>
            </div>
            <p class="text-gray-600 mb-4">Kelola backup data dan restore sistem</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-md transition duration-300">
                <i class="fas fa-download mr-2"></i> Backup
            </a>
        </div>

        <!-- Log Sistem -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-file-alt text-2xl text-gray-600 mr-3"></i>
                <h3 class="text-xl font-semibold text-gray-900">Log Sistem</h3>
            </div>
            <p class="text-gray-600 mb-4">Lihat log aktivitas dan error sistem</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-md transition duration-300">
                <i class="fas fa-eye mr-2"></i> Lihat
            </a>
        </div>

        <!-- Informasi Sistem -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center mb-4">
                <i class="fas fa-info-circle text-2xl text-indigo-600 mr-3"></i>
                <h3 class="text-xl font-semibold text-gray-900">Informasi Sistem</h3>
            </div>
            <p class="text-gray-600 mb-4">Informasi versi dan status sistem</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition duration-300">
                <i class="fas fa-info mr-2"></i> Detail
            </a>
        </div>
    </div>

    <!-- Informasi Role -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Informasi Hak Akses</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-orange-50 rounded-lg border border-orange-200">
                <h4 class="font-semibold text-orange-800 mb-2">Owner</h4>
                <p class="text-sm text-orange-700">Akses penuh ke semua fitur sistem</p>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                <h4 class="font-semibold text-blue-800 mb-2">Admin</h4>
                <p class="text-sm text-blue-700">Dashboard, Reservasi, History, Jenis Kerusakan, Jadwal, Data Pelanggan, Ulasan, Klaim Garansi</p>
            </div>
            <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                <h4 class="font-semibold text-green-800 mb-2">Teknisi</h4>
                <p class="text-sm text-green-700">Panel Teknisi dan Pengaturan</p>
            </div>
        </div>
    </div>
</div>
@endsection 