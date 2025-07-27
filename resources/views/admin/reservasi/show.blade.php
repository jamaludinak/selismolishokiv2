@extends('layouts.admin')

@section('title', 'Detail Reservasi')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-calendar-check mr-3 text-4xl"></i>
                            Detail Reservasi
                        </h1>
                        <p class="text-orange-100 mt-2">No. Resi: {{ $reservasi->noResi }}</p>
                    </div>
                    <a href="{{ route('admin.reservasi.index') }}"
                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Information Card -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Reservasi -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                Informasi Reservasi
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">No. Resi</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <p class="text-gray-900 font-semibold">{{ $reservasi->noResi }}</p>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Status</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            @if ($reservasi->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($reservasi->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($reservasi->status == 'process') bg-indigo-100 text-indigo-800
                                            @elseif($reservasi->status == 'completed') bg-green-100 text-green-800
                                            @elseif($reservasi->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($reservasi->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Nama Lengkap</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <p class="text-gray-900 font-semibold">{{ $reservasi->namaLengkap }}</p>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">No. Telepon</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $reservasi->noTelp), '0') }}"
                                                target="_blank" class="text-blue-600 hover:underline flex items-center">
                                                {{ $reservasi->noTelp }} <i class="fab fa-whatsapp ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Alamat Lengkap</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <p class="text-gray-900 font-semibold">{{ $reservasi->alamatLengkap }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Jenis Servis</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-blue-500">
                                            <p class="text-gray-900 font-semibold">{{ $reservasi->servis }}</p>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Jenis Kerusakan</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-blue-500">
                                            <p class="text-gray-900 font-semibold">
                                                {{ $reservasi->jenisKerusakan->nama ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    @if ($reservasi->teknisi)
                                        <div class="group">
                                            <label class="text-sm font-medium text-gray-600 block mb-1">Teknisi</label>
                                            <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-green-500">
                                                <p class="text-green-600 font-semibold">{{ $reservasi->teknisi->name }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Deskripsi
                                            Kerusakan</label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-red-500">
                                            <p class="text-gray-800 leading-relaxed">{{ $reservasi->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumentasi Kerusakan -->
                    @if ($reservasi->gambar || $reservasi->video)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="bg-white border-b border-gray-200 px-6 py-4">
                                <h3 class="text-xl font-semibold text-black flex items-center">
                                    <i class="fas fa-camera mr-2 text-pink-500"></i>
                                    Dokumentasi Kerusakan
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @if ($reservasi->gambar)
                                        <div>
                                            <label class="text-sm font-medium text-gray-600 block mb-2">
                                                <i class="fas fa-image text-pink-500 mr-2"></i>Foto Kerusakan
                                            </label>
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <img src="{{ url($reservasi->gambar) }}" alt="Foto Kerusakan"
                                                    class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                                    onclick="openImageModal('{{ url($reservasi->gambar) }}')">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($reservasi->video)
                                        <div>
                                            <label class="text-sm font-medium text-gray-600 block mb-2">
                                                <i class="fas fa-video text-purple-500 mr-2"></i>Video Kerusakan
                                            </label>
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <video controls class="w-full h-48 rounded-lg">
                                                    <source src="{{ url($reservasi->video) }}" type="video/mp4">
                                                    Browser Anda tidak mendukung video.
                                                </video>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Rincian Biaya (jika ada) -->
                    @if (isset($reservasi->total_harga))
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
                                        <span class="font-semibold text-gray-900">Rp
                                            {{ number_format($reservasi->total_harga, 0, ',', '.') }}</span>
                                    </div>
                                    @if (isset($reservasi->biaya_perjalanan) && $reservasi->biaya_perjalanan > 0)
                                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                            <span class="text-gray-600">Biaya Perjalanan:</span>
                                            <span class="font-semibold text-gray-900">Rp
                                                {{ number_format($reservasi->biaya_perjalanan, 0, ',', '.') }}</span>
                                        </div>
                                    @endif
                                    <div
                                        class="flex justify-between items-center py-3 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg px-4">
                                        <span class="font-medium text-gray-800">Total Biaya:</span>
                                        <span class="text-xl font-bold text-green-600">
                                            Rp
                                            {{ number_format(($reservasi->total_harga ?? 0) + ($reservasi->biaya_perjalanan ?? 0), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Riwayat Status -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-6">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-history mr-2 text-indigo-500"></i>
                                Riwayat Status
                            </h3>
                        </div>
                        <div class="p-6">
                            @if ($riwayats->isEmpty())
                                <div class="text-center text-gray-500 italic">
                                    <i class="fas fa-history text-4xl mb-2"></i>
                                    <p>Tidak ada riwayat status untuk reservasi ini.</p>
                                </div>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tanggal & Waktu</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($riwayats as $riwayat)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 text-sm text-gray-800">
                                                        {{ \Carbon\Carbon::parse($riwayat->created_at)->locale('id')->timezone('Asia/Jakarta')->translatedFormat('l, d F Y - H:i:s') }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                @if ($riwayat->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($riwayat->status == 'confirmed') bg-blue-100 text-blue-800
                                                @elseif($riwayat->status == 'process') bg-indigo-100 text-indigo-800
                                                @elseif($riwayat->status == 'completed') bg-green-100 text-green-800
                                                @elseif($riwayat->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                            {{ ucfirst($riwayat->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Sidebar kosong (admin tidak perlu aksi cepat/garansi) -->
            </div>
        </div>
    </div>
    <!-- Modal Image Viewer -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50"
        onclick="closeImageModal()">
        <div class="max-w-4xl max-h-full p-4">
            <img id="modalImage" src="" alt="Full size image"
                class="max-w-full max-h-full object-contain rounded-lg">
        </div>
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !document.getElementById('imageModal').classList.contains('hidden')) {
                closeImageModal();
            }
        });
    </script>
@endsection