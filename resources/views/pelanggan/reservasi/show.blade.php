@extends('pelanggan.layouts.app')
@section('title', 'Detail Reservasi')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Detail Reservasi</h1>
                    <p class="text-blue-100 mt-1">Informasi lengkap reservasi servis Anda</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('reservasi.index') }}"
                        class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 font-medium text-sm transition-all duration-300 shadow-md text-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                    @if($reservasi->status == 'pending')
                    <a href="{{ route('reservasi.edit', $reservasi->id) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 font-medium text-sm transition-all duration-300 shadow-md text-center">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Status Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>Informasi Reservasi
                            </h2>
                            @php
                                $statusClass = match($reservasi->status) {
                                    'pending' => 'bg-yellow-500',
                                    'confirmed' => 'bg-blue-500',
                                    'process' => 'bg-indigo-500',
                                    'completed' => 'bg-green-500',
                                    'cancelled' => 'bg-red-500',
                                    default => 'bg-gray-500'
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white {{ $statusClass }}">
                                <i class="fas fa-circle text-xs mr-2"></i>{{ ucfirst($reservasi->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Main Details -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-receipt text-orange-500 mr-2"></i>No. Resi
                                    </label>
                                    <p class="text-lg font-bold font-mono text-orange-600 mt-1">{{ $reservasi->noResi }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-user text-blue-500 mr-2"></i>Nama Lengkap
                                    </label>
                                    <p class="text-gray-900 mt-1 font-medium">{{ $reservasi->namaLengkap }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-phone text-green-500 mr-2"></i>No. Telepon
                                    </label>
                                    <p class="text-gray-900 mt-1 font-mono">{{ $reservasi->noTelp }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-tools text-purple-500 mr-2"></i>Jenis Layanan
                                    </label>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($reservasi->servis == 'Home Service') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $reservasi->servis }}
                                    </span>
                                </div>
                            </div>

                            <!-- Service Details -->
                            <div class="space-y-4">
                                @if($reservasi->kendaraan)
                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-motorcycle text-orange-500 mr-2"></i>Kendaraan
                                    </label>
                                    <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                        <p class="font-medium">{{ $reservasi->kendaraan->merk }} {{ $reservasi->kendaraan->tipe }}</p>
                                        <p class="text-sm text-gray-600">{{ ucfirst(str_replace('_', ' ', $reservasi->kendaraan->jenis_kendaraan)) }}</p>
                                        <p class="text-xs text-gray-500 font-mono">Kode: {{ $reservasi->kendaraan->kode }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($reservasi->jenisKerusakan)
                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-wrench text-red-500 mr-2"></i>Jenis Kerusakan
                                    </label>
                                    <div class="mt-1 p-3 bg-red-50 rounded-lg">
                                        <p class="font-medium text-red-800">{{ $reservasi->jenisKerusakan->nama }}</p>
                                        <p class="text-sm text-red-600">Estimasi: Rp {{ number_format($reservasi->jenisKerusakan->biaya_estimasi ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($reservasi->alamatLengkap)
                                <div>
                                    <label class="text-sm font-medium text-gray-600 flex items-center">
                                        <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>Alamat Layanan
                                    </label>
                                    <div class="mt-1 p-3 bg-green-50 rounded-lg">
                                        <p class="text-gray-900">{{ $reservasi->alamatLengkap }}</p>
                                        @if($reservasi->biaya_perjalanan > 0)
                                        <p class="text-sm text-green-600 mt-1">Biaya Perjalanan: Rp {{ number_format($reservasi->biaya_perjalanan, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        @if($reservasi->deskripsi)
                        <div class="mt-6">
                            <label class="text-sm font-medium text-gray-600 flex items-center">
                                <i class="fas fa-comment-alt text-indigo-500 mr-2"></i>Deskripsi Masalah
                            </label>
                            <div class="mt-2 p-4 bg-indigo-50 rounded-lg border-l-4 border-indigo-400">
                                <p class="text-gray-900">{{ $reservasi->deskripsi }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Media Files -->
                        @if($reservasi->gambar || $reservasi->video)
                        <div class="mt-6">
                            <label class="text-sm font-medium text-gray-600 flex items-center mb-3">
                                <i class="fas fa-camera text-pink-500 mr-2"></i>Dokumentasi
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($reservasi->gambar)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium mb-2">Foto Kerusakan</h4>
                                    <img src="{{ asset($reservasi->gambar) }}" alt="Foto Kerusakan" 
                                         class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                         onclick="openImageModal('{{ asset($reservasi->gambar) }}')">
                                </div>
                                @endif

                                @if($reservasi->video)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium mb-2">Video Kerusakan</h4>
                                    <video controls class="w-full h-48 rounded-lg">
                                        <source src="{{ asset($reservasi->video) }}" type="video/mp4">
                                        Browser Anda tidak mendukung video.
                                    </video>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="space-y-6">
                <!-- Schedule Information -->
                @if($reservasi->reqJadwals && $reservasi->reqJadwals->first())
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 px-4 py-3 border-b">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-calendar-alt text-orange-500 mr-2"></i>Jadwal Layanan
                        </h3>
                    </div>
                    <div class="p-4 space-y-3">
                        <div>
                            <label class="text-xs font-medium text-gray-600">Tanggal</label>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($reservasi->reqJadwals->first()->tanggal)->format('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-600">Waktu</label>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($reservasi->reqJadwals->first()->waktuMulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($reservasi->reqJadwals->first()->waktuSelesai)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Cost Breakdown -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-green-100 px-4 py-3 border-b">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-calculator text-green-500 mr-2"></i>Rincian Biaya
                        </h3>
                    </div>
                    <div class="p-4 space-y-3">
                        @if($reservasi->jenisKerusakan)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Estimasi Perbaikan</span>
                            <span class="text-sm font-semibold">Rp {{ number_format($reservasi->jenisKerusakan->biaya_estimasi ?? 0, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        @if($reservasi->biaya_perjalanan > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Biaya Perjalanan</span>
                            <span class="text-sm font-semibold">Rp {{ number_format($reservasi->biaya_perjalanan, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        @if($reservasi->total_harga > 0)
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-sm font-semibold text-gray-800">Total Biaya Aktual</span>
                                <span class="text-sm font-bold text-green-600">Rp {{ number_format($reservasi->total_harga + ($reservasi->biaya_perjalanan ?? 0), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @else
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-sm font-semibold text-gray-800">Estimasi Total</span>
                                <span class="text-sm font-bold text-blue-600">Rp {{ number_format(($reservasi->jenisKerusakan->biaya_estimasi ?? 0) + ($reservasi->biaya_perjalanan ?? 0), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Status History -->
                @if($reservasi->riwayats && $reservasi->riwayats->count() > 0)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-4 py-3 border-b">
                        <h3 class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-history text-purple-500 mr-2"></i>Riwayat Status
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            @foreach($reservasi->riwayats->sortByDesc('created_at') as $riwayat)
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-3 h-3 rounded-full 
                                    @if($riwayat->status == 'completed') bg-green-500
                                    @elseif($riwayat->status == 'process') bg-blue-500
                                    @elseif($riwayat->status == 'confirmed') bg-yellow-500
                                    @else bg-gray-400 @endif">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 capitalize">{{ $riwayat->status }}</p>
                                    <p class="text-xs text-gray-500">{{ $riwayat->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-cogs text-gray-500 mr-2"></i>Aksi
                    </h3>
                    <div class="space-y-2">
                        @if($reservasi->status == 'pending')
                        <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="delete-form" data-entity="reservasi">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-trash mr-2"></i>Batalkan Reservasi
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('reservasi.index') }}"
                            class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>Lihat Semua Reservasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
        <div class="relative max-w-4xl max-h-full p-4">
            <img id="modalImage" src="" alt="Detail Gambar" class="max-w-full max-h-full rounded-lg">
            <button onclick="closeImageModal()" 
                class="absolute top-2 right-2 bg-white text-gray-800 rounded-full p-2 hover:bg-gray-100 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForm = document.querySelector('.delete-form');
            if (deleteForm) {
                deleteForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Apakah Anda yakin ingin membatalkan reservasi ini? Tindakan ini tidak dapat dibatalkan.')) {
                        this.submit();
                    }
                });
            }
        });
    </script>
@endsection
