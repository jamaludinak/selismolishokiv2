@extends('pelanggan.layouts.app')
@section('title', 'Ajukan Klaim Garansi')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-4xl"></i>
                            Ajukan Klaim Garansi
                        </h1>
                        <p class="text-orange-100 mt-2">Ajukan klaim untuk kendaraan yang masih dalam masa garansi</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('klaim-garansi.index') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Reservation Information Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <h3 class="text-xl font-semibold text-black flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Informasi Reservasi
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center">
                                        <i class="fas fa-receipt text-orange-600 text-lg"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">No. Resi</p>
                                    <p class="text-lg font-bold text-gray-900 font-mono">{{ $reservasi->noResi }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-motorcycle text-blue-600 text-lg"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Kendaraan</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        @if($reservasi->kendaraan)
                                            {{ $reservasi->kendaraan->merk }} {{ $reservasi->kendaraan->tipe }}
                                        @else
                                            Kode: {{ $reservasi->kendaraan->kode ?? '-' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Status Reservasi</p>
                                    <p class="text-lg font-bold text-gray-900">{{ ucfirst($reservasi->status) }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-calendar-times text-red-600 text-lg"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Garansi Berakhir</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal_berakhir_garansi)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Claim Form Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <h3 class="text-xl font-semibold text-black flex items-center">
                        <i class="fas fa-file-upload mr-2 text-orange-500"></i>
                        Form Klaim Garansi
                    </h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('klaim-garansi.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="reservasi_id" value="{{ $reservasi->id }}">

                        <!-- Upload Photo Section -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-camera mr-2 text-orange-500"></i>Upload Foto Bukti
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       name="bukti" 
                                       id="bukti"
                                       required 
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition-all duration-200">
                                <div class="mt-2 text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.
                                </div>
                            </div>
                            @error('bukti')
                                <div class="flex items-center mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description Section -->
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-edit mr-2 text-blue-500"></i>Keterangan Kerusakan (Opsional)
                            </label>
                            <textarea name="keterangan" 
                                      rows="4" 
                                      placeholder="Jelaskan masalah yang terjadi pada kendaraan Anda..."
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 resize-none"></textarea>
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-lightbulb mr-1"></i>
                                Semakin detail keterangan yang Anda berikan, semakin mudah proses verifikasi klaim.
                            </div>
                            @error('keterangan')
                                <div class="flex items-center mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="submit" 
                                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Klaim Garansi
                            </button>
                            <a href="{{ route('klaim-garansi.index') }}" 
                               class="flex-1 sm:flex-none bg-gray-500 hover:bg-gray-600 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Help Section -->
            <div class="mt-8 bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-question-circle text-2xl text-gray-600"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold mb-2 text-black">Bantuan Klaim Garansi</h4>
                        <ul class="space-y-1 text-gray-700 text-sm">
                            <li><i class="fas fa-check mr-2 text-green-500"></i>Pastikan foto bukti jelas dan menunjukkan kerusakan</li>
                            <li><i class="fas fa-check mr-2 text-green-500"></i>Sertakan keterangan detail tentang masalah yang terjadi</li>
                            <li><i class="fas fa-check mr-2 text-green-500"></i>Klaim akan diproses dalam 1-3 hari kerja</li>
                            <li><i class="fas fa-check mr-2 text-green-500"></i>Anda akan mendapat notifikasi status klaim via dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
