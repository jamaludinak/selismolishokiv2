@extends('layouts.admin')

@section('title', 'Detail Reservasi')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-extrabold text-gray-900">Detail Reservasi</h2>
        <a href="{{ route('admin.reservasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-300 transition duration-300 ease-in-out">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white shadow-lg rounded-lg p-6 border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Informasi Reservasi</h3>
            <div class="divide-y divide-gray-200">
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">No. Resi:</span>
                    <span class="text-lg font-mono text-orange-600">{{ $reservasi->noResi }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Status:</span>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        @if($reservasi->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($reservasi->status == 'confirmed') bg-blue-100 text-blue-800
                        @elseif($reservasi->status == 'process') bg-indigo-100 text-indigo-800
                        @elseif($reservasi->status == 'completed') bg-green-100 text-green-800
                        @elseif($reservasi->status == 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($reservasi->status) }}
                    </span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Nama Lengkap:</span>
                    <span class="text-gray-800">{{ $reservasi->namaLengkap }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">No. Telepon:</span>
                    <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $reservasi->noTelp), '0') }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                        {{ $reservasi->noTelp }} <i class="fab fa-whatsapp ml-2"></i>
                    </a>
                </div>
                <div class="py-3">
                    <span class="font-semibold text-gray-700 block mb-1">Alamat Lengkap:</span>
                    <p class="text-gray-800">{{ $reservasi->alamatLengkap }}</p>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Jenis Servis:</span>
                    <span class="text-gray-800">{{ $reservasi->servis }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Jenis Kerusakan:</span>
                    <span class="text-gray-800">{{ $reservasi->jenisKerusakan->nama ?? 'N/A' }}</span>
                </div>
                @if($reservasi->teknisi)
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Teknisi:</span>
                    <span class="text-green-600 font-semibold">{{ $reservasi->teknisi->name }}</span>
                </div>
                @endif
            </div>
            
            <div class="mt-6">
                <h4 class="text-xl font-bold text-gray-800 mb-2">Deskripsi Kerusakan</h4>
                <p class="text-gray-700 leading-relaxed">{{ $reservasi->deskripsi }}</p>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Gambar Kerusakan</h3>
                @if($reservasi->gambar)
                    <img src="{{ url('storage/' . $reservasi->gambar) }}" alt="Gambar Kerusakan" class="w-full h-auto rounded-lg shadow-md object-cover cursor-pointer hover:scale-105 transition-transform duration-300" onclick="openImageModal('{{ url('storage/' . $reservasi->gambar) }}')">
                @else
                    <div class="text-center py-4 text-gray-500 italic">
                        <i class="fas fa-image text-4xl mb-2"></i>
                        <p>Gambar tidak tersedia.</p>
                    </div>
                @endif
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Video Kerusakan</h3>
                @if($reservasi->video)
                    <video controls class="w-full h-auto rounded-lg shadow-md">
                        <source src="{{ url('storage/' . $reservasi->video) }}" type="video/mp4">
                        Maaf, browser Anda tidak mendukung tag video.
                    </video>
                @else
                    <div class="text-center py-4 text-gray-500 italic">
                        <i class="fas fa-video text-4xl mb-2"></i>
                        <p>Video tidak tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mt-6 border border-gray-200">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Status</h3>
        @if($riwayats->isEmpty())
            <div class="text-center py-4 text-gray-500 italic">
                <i class="fas fa-history text-4xl mb-2"></i>
                <p>Tidak ada riwayat status untuk reservasi ini.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($riwayats as $riwayat)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ \Carbon\Carbon::parse($riwayat->created_at)->locale('id')->timezone('Asia/Jakarta')->translatedFormat('l, d F Y - H:i:s') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($riwayat->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($riwayat->status == 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($riwayat->status == 'process') bg-indigo-100 text-indigo-800
                                    @elseif($riwayat->status == 'completed') bg-green-100 text-green-800
                                    @elseif($riwayat->status == 'cancelled') bg-red-100 text-red-800
                                    @endif">
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

<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="relative">
        <button class="absolute top-4 right-4 text-white text-3xl z-50" onclick="closeImageModal()">
            <i class="fas fa-times-circle"></i>
        </button>
        <img id="modalImage" src="" alt="Full size image" class="max-w-full max-h-[90vh] object-contain">
    </div>
</div>

<script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Prevent scrolling behind modal
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden'); // Restore scrolling
    }

    // Close modal if escape key is pressed
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !document.getElementById('imageModal').classList.contains('hidden')) {
            closeImageModal();
        }
    });
</script>
@endsection