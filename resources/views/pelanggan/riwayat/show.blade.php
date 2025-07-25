@extends('pelanggan.layouts.app')

@section('title', 'Detail Riwayat Servis')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-file-alt mr-3 text-4xl"></i>
                            Detail Riwayat Reservasi
                        </h1>
                        <p class="text-orange-100 mt-2">No. Resi: {{ $riwayat->noResi }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('riwayats.index') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Riwayat
                        </a>
                        @if($riwayat->status === 'completed' && $riwayat->tanggal_berakhir_garansi && \Carbon\Carbon::parse($riwayat->tanggal_berakhir_garansi)->isFuture() && !$riwayat->klaimGaransi)
                            <a href="{{ route('klaim-garansi.create', ['noResi' => $riwayat->noResi]) }}" 
                               class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Klaim Garansi
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Information Card -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Service Basic Info -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-info-circle mr-2 text-green-500"></i>
                                Informasi Servis
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-receipt text-green-500 mr-2"></i>No. Resi
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-green-500">
                                            <p class="text-lg font-mono font-semibold text-gray-900">{{ $riwayat->noResi }}</p>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-calendar text-blue-500 mr-2"></i>Tanggal Servis
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-blue-500">
                                            <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('d F Y') }}</p>
                                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('H:i') }} WIB</p>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-motorcycle text-purple-500 mr-2"></i>Kendaraan
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-purple-500">
                                            <p class="text-lg font-semibold text-gray-900">{{ $riwayat->data_kendaraan }}</p>
                                            @if($riwayat->kendaraan)
                                                <p class="text-sm text-gray-600">{{ $riwayat->kendaraan->merk ?? '' }} {{ $riwayat->kendaraan->tipe ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-wrench text-indigo-500 mr-2"></i>Jenis Kerusakan
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <p class="text-lg font-semibold text-gray-900">{{ $riwayat->jenis_kerusakan ?? 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-info-circle text-orange-500 mr-2"></i>Status Servis
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-orange-500">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                @if($riwayat->status === 'completed') bg-green-100 text-green-800
                                                @elseif($riwayat->status === 'in_progress') bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                @if($riwayat->status === 'completed') 
                                                    <i class="fas fa-check-circle mr-2"></i>Selesai
                                                @elseif($riwayat->status === 'in_progress') 
                                                    <i class="fas fa-cog mr-2"></i>Dalam Proses
                                                @else 
                                                    <i class="fas fa-clock mr-2"></i>Menunggu
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photo and Video Section -->
                    @if($riwayat->gambar || $riwayat->video)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-camera mr-2 text-pink-500"></i>
                                Dokumentasi Kerusakan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if($riwayat->gambar)
                                <div>
                                    <label class="text-sm font-medium text-gray-600 block mb-2">
                                        <i class="fas fa-image text-pink-500 mr-2"></i>Foto Kerusakan
                                    </label>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <img src="{{ asset($riwayat->gambar) }}" alt="Foto Kerusakan" 
                                             class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                             onclick="openImageModal('{{ asset($riwayat->gambar) }}')">
                                    </div>
                                </div>
                                @endif

                                @if($riwayat->video)
                                <div>
                                    <label class="text-sm font-medium text-gray-600 block mb-2">
                                        <i class="fas fa-video text-purple-500 mr-2"></i>Video Kerusakan
                                    </label>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <video controls class="w-full h-48 rounded-lg">
                                            <source src="{{ asset($riwayat->video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung video.
                                        </video>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Cost Breakdown -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-money-bill-wave mr-2 text-orange-500"></i>
                                Rincian Biaya
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600">Biaya Servis:</span>
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($riwayat->total_harga, 0, ',', '.') }}</span>
                                </div>
                                @if($riwayat->biaya_perjalanan > 0)
                                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                    <span class="text-gray-600">Biaya Perjalanan:</span>
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($riwayat->biaya_perjalanan, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between items-center py-3 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg px-4">
                                    <span class="font-medium text-gray-800">Total Biaya:</span>
                                    <span class="text-xl font-bold text-green-600">Rp {{ number_format($riwayat->total_harga + $riwayat->biaya_perjalanan, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Warranty Status Card -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-shield-alt mr-2 text-yellow-500"></i>
                                Status Garansi
                            </h3>
                        </div>
                        <div class="p-6">
                            @if($riwayat->tanggal_berakhir_garansi)
                                @php
                                    $tanggalGaransi = \Carbon\Carbon::parse($riwayat->tanggal_berakhir_garansi);
                                    $isAktif = $tanggalGaransi->isFuture();
                                    $sisaHari = $isAktif ? $tanggalGaransi->diffInDays(now()) : 0;
                                @endphp
                                
                                <div class="text-center mb-4">
                                    <div class="mx-auto w-20 h-20 rounded-full flex items-center justify-center mb-3
                                        @if($isAktif) bg-green-100 @else bg-red-100 @endif">
                                        <i class="@if($isAktif) fas fa-check-circle text-green-500 @else fas fa-times-circle text-red-500 @endif text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold 
                                        @if($isAktif) text-green-700 @else text-red-700 @endif">
                                        @if($isAktif) Garansi Aktif @else Garansi Berakhir @endif
                                    </h4>
                                </div>

                                <div class="space-y-3">
                                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Tanggal Berakhir</label>
                                        <p class="font-semibold text-gray-900">{{ $tanggalGaransi->format('d F Y') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fas fa-question-circle text-gray-400 text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Garansi</h4>
                                    <p class="text-gray-500 text-sm">Informasi garansi belum tersedia untuk servis ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Cards -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-tools mr-2 text-indigo-500"></i>
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            @if($riwayat->status === 'completed' && $riwayat->tanggal_berakhir_garansi && \Carbon\Carbon::parse($riwayat->tanggal_berakhir_garansi)->isFuture() && !$riwayat->klaimGaransi)
                            <a href="{{ route('klaim-garansi.create', ['noResi' => $riwayat->noResi]) }}" 
                               class="w-full bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                <i class="fas fa-shield-alt mr-2 group-hover:scale-110 transition-transform"></i>
                                Klaim Garansi
                            </a>
                            @elseif($riwayat->klaimGaransi)
                            <div class="w-full bg-gray-100 text-gray-600 px-4 py-3 rounded-lg font-medium flex items-center justify-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Sudah Klaim Garansi
                            </div>
                            @endif

                            <a href="{{ route('reservasi.create') }}" 
                               class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                <i class="fas fa-calendar-plus mr-2 group-hover:scale-110 transition-transform"></i>
                                Buat Reservasi Baru
                            </a>

                            <a href="{{ route('riwayats.index') }}" 
                               class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                <i class="fas fa-list mr-2 group-hover:scale-110 transition-transform"></i>
                                Lihat Semua Riwayat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
