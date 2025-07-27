@extends('layouts.admin')

@section('title', 'Detail Klaim Garansi')

@push('styles')
    <style>
        /* Custom animations and hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gradient-border {
            background: linear-gradient(45deg, #f97316, #ea580c);
            padding: 2px;
            border-radius: 8px;
        }

        .gradient-border-inner {
            background: white;
            border-radius: 6px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
            display: flex;
            align-items: center;
        }

        .info-value {
            color: #1f2937;
            font-weight: 500;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white mb-2">Detail Klaim Garansi</h2>
                    <p class="text-orange-100">Informasi lengkap klaim garansi pelanggan</p>
                </div>
                <a href="{{ route('admin.klaim-garansi.index') }}"
                    class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-white text-orange-600 font-semibold rounded-lg shadow-md hover:bg-gray-50 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md"
                role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md"
                role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Terjadi kesalahan:</span>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Detail Klaim -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover animate-fade-in">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-file-invoice mr-2"></i>
                        Informasi Klaim
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="info-item">
                            <div class="info-label flex items-center mb-1">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                Status:
                            </div>
                            <div class="info-value">
                                @if ($klaimGaransi->status == 'diajukan')
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Diajukan
                                    </span>
                                @elseif($klaimGaransi->status == 'diterima')
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Diterima
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i>
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label flex items-center mb-1">
                                <i class="fas fa-calendar-plus text-green-500 mr-2"></i>
                                Tanggal Pengajuan:
                            </div>
                            <div class="info-value bg-gray-100 p-2 rounded font-semibold">
                                {{ $klaimGaransi->created_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>

                        @if ($klaimGaransi->tanggal_diproses)
                            <div class="info-item">
                                <div class="info-label flex items-center mb-1">
                                    <i class="fas fa-calendar-check text-blue-500 mr-2"></i>
                                    Tanggal Diproses:
                                </div>
                                <div class="info-value bg-gray-100 p-2 rounded font-semibold">
                                    {{ $klaimGaransi->tanggal_diproses->format('d/m/Y H:i:s') }}
                                </div>
                            </div>
                        @endif

                        <div class="info-item">
                            <div class="info-label flex items-center mb-1">
                                <i class="fas fa-comment text-purple-500 mr-2"></i>
                                Keterangan:
                            </div>
                            <div class="info-value bg-gray-100 p-2 rounded font-semibold">
                                {{ $klaimGaransi->keterangan ?: 'Tidak ada keterangan' }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-camera text-orange-500 mr-2"></i>
                            Bukti Foto
                        </h4>
                        @if ($klaimGaransi->bukti)
                            <div class="gradient-border">
                                <div class="gradient-border-inner p-2">
                                    <img src="{{ asset($klaimGaransi->bukti) }}" alt="Bukti Klaim"
                                        class="w-full h-auto rounded-lg shadow-md hover:shadow-lg transition duration-300"
                                        style="max-height: 400px; object-fit: contain;">
                                </div>
                            </div>
                        @else
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                                <p class="text-gray-500">Tidak ada bukti foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detail Reservasi -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover animate-fade-in">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Informasi Reservasi
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="info-label">
                                    <i class="fas fa-receipt text-orange-500 mr-2"></i>
                                    No. Resi
                                </span>
                            </div>
                            <div
                                class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-orange-500 font-mono text-orange-600 font-bold">
                                {{ $klaimGaransi->reservasi->noResi ?? '-' }}
                            </div>

                            <div class="flex items-center mt-4">
                                <span class="info-label">
                                    <i class="fas fa-user text-blue-500 mr-2"></i>
                                    Nama Pelanggan
                                </span>
                            </div>
                            <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-blue-500">
                                {{ $klaimGaransi->dataPelanggan->nama ?? ($klaimGaransi->reservasi->nama ?? '-') }}
                            </div>

                            <div class="flex items-center mt-4">
                                <span class="info-label">
                                    <i class="fas fa-phone text-green-500 mr-2"></i>
                                    No. Telepon
                                </span>
                            </div>
                            <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-green-500">
                                <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $klaimGaransi->reservasi->noTelp ?? ''), '0') }}"
                                    target="_blank">
                                    {{ $klaimGaransi->reservasi->noTelp ?? '-' }}
                                </a>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="info-label">
                                    <i class="fas fa-wrench text-purple-500 mr-2"></i>
                                    Jenis Servis
                                </span>
                            </div>
                            <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-purple-500">
                                {{ $klaimGaransi->reservasi->jenis_servis ?? '-' }}
                            </div>

                            <div class="flex items-center mt-4">
                                <span class="info-label">
                                    <i class="fas fa-calendar text-indigo-500 mr-2"></i>
                                    Tanggal Servis
                                </span>
                            </div>
                            <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                {{ $klaimGaransi->reservasi->tanggal_servis ? date('d/m/Y', strtotime($klaimGaransi->reservasi->tanggal_servis)) : '-' }}
                            </div>

                            @if ($klaimGaransi->reservasi->tanggal_berakhir_garansi)
                                <div class="flex items-center mt-4">
                                    <span class="info-label">
                                        <i class="fas fa-shield-alt text-red-500 mr-2"></i>
                                        Berakhir Garansi
                                    </span>
                                </div>
                                <div
                                    class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-red-500 text-red-600 font-semibold">
                                    {{ date('d/m/Y', strtotime($klaimGaransi->reservasi->tanggal_berakhir_garansi)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        @if ($klaimGaransi->status == 'diajukan')
            <div class="mt-6 bg-white rounded-lg shadow-lg p-6 animate-fade-in">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cogs text-orange-500 mr-2"></i>
                    Aksi Klaim
                </h3>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <form action="{{ route('admin.klaim-garansi.approve', $klaimGaransi->id) }}" method="POST"
                        class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105"
                            onclick="return confirm('Yakin ingin menyetujui klaim garansi ini?')">
                            <i class="fas fa-check mr-2"></i>Setujui Klaim
                        </button>
                    </form>

                    <form action="{{ route('admin.klaim-garansi.reject', $klaimGaransi->id) }}" method="POST"
                        class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300 ease-in-out transform hover:scale-105"
                            onclick="return confirm('Yakin ingin menolak klaim garansi ini?')">
                            <i class="fas fa-times mr-2"></i>Tolak Klaim
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
