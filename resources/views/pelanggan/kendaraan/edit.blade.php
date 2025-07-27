@extends('pelanggan.layouts.app')
@section('title', 'Edit Kendaraan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-edit mr-3 text-4xl"></i>
                            Edit Kendaraan
                        </h1>
                        <p class="text-orange-100 mt-2">Perbarui informasi kendaraan: {{ $kendaraan->merk }}
                            {{ $kendaraan->tipe }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('kendaraan.index') }}"
                            class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                        <a href="{{ route('kendaraan.show', $kendaraan->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-orange-500 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Form Edit Kendaraan
                    </h3>
                </div>

                <form method="POST" action="{{ route('kendaraan.update', $kendaraan->id) }}" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="group">
                                <label for="merk" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-tag text-green-500 mr-2"></i>Merk Kendaraan
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" id="merk" name="merk" value="{{ $kendaraan->merk }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                                @error('merk')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="jenis_kendaraan" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-list text-blue-500 mr-2"></i>Jenis Kendaraan
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <select id="jenis_kendaraan" name="jenis_kendaraan" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                                    <option value="">-- Pilih Jenis Kendaraan --</option>
                                    <option value="sepeda_listrik"
                                        {{ $kendaraan->jenis_kendaraan == 'sepeda_listrik' ? 'selected' : '' }}>
                                        Sepeda Listrik
                                    </option>
                                    <option value="motor_listrik"
                                        {{ $kendaraan->jenis_kendaraan == 'motor_listrik' ? 'selected' : '' }}>
                                        Motor Listrik
                                    </option>
                                </select>
                                @error('jenis_kendaraan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="tipe" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-cogs text-purple-500 mr-2"></i>Tipe Kendaraan
                                </label>
                                <input type="text" id="tipe" name="tipe" value="{{ $kendaraan->tipe }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                                @error('tipe')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="group">
                                <label for="nomor_rangka" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-barcode text-indigo-500 mr-2"></i>Nomor Rangka
                                </label>
                                <input type="text" id="nomor_rangka" name="nomor_rangka"
                                    value="{{ $kendaraan->nomor_rangka }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                                @error('nomor_rangka')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="tahun_pembelian" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-calendar text-orange-500 mr-2"></i>Tahun Pembelian
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="number" id="tahun_pembelian" name="tahun_pembelian" min="2000"
                                    max="{{ date('Y') + 1 }}" value="{{ $kendaraan->tahun_pembelian }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200">
                                @error('tahun_pembelian')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="foto" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-camera text-pink-500 mr-2"></i>Foto Kendaraan
                                </label>
                                <div class="space-y-3">
                                    @if ($kendaraan->foto)
                                        <div class="relative group">
                                            <img src="{{ asset($kendaraan->foto) }}" alt="Foto {{ $kendaraan->merk }}"
                                                class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 group-hover:border-orange-300 transition-colors cursor-pointer"
                                                onclick="openImageModal('{{ asset($kendaraan->foto) }}')">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-300 flex items-center justify-center">
                                                <i
                                                    class="fas fa-search-plus text-white text-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500">Foto saat ini. Pilih file baru untuk mengubah.</p>
                                    @endif
                                    <input type="file" id="foto" name="foto" accept="image/*"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                                </div>
                                @error('foto')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 bg-orange-500 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                            <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('kendaraan.index') }}"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                            <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Help Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mt-8">
                <div class="text-center">
                    <i class="fas fa-info-circle text-3xl mb-3 text-gray-600"></i>
                    <h3 class="text-lg font-semibold mb-2 text-black">Tips Edit Kendaraan</h3>
                    <div class="text-gray-700 text-sm space-y-1">
                        <p>• Pastikan data yang diubah sudah benar sebelum menyimpan</p>
                        <p>• Foto baru akan menggantikan foto lama jika diupload</p>
                        <p>• Perubahan data akan mempengaruhi riwayat servis</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50"
            onclick="closeImageModal()">
            <div class="max-w-4xl max-h-full p-4">
                <img id="modalImage" src="" alt="Enlarged view"
                    class="max-w-full max-h-full object-contain rounded-lg">
            </div>
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <script>
        // Image modal functions
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            form.addEventListener('submit', function(e) {
                // Disable button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Optional: Add form validation here if needed
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                        
                        // Remove error styling after user starts typing
                        field.addEventListener('input', function() {
                            field.classList.remove('border-red-500');
                        }, { once: true });
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    alert('Mohon lengkapi semua field yang wajib diisi!');
                }
            });
        });
    </script>
@endsection
