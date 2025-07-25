@extends('pelanggan.layouts.            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <h3 class="text-xl font-semibold text-black flex items-center">
                        <i class="fas fa-motorcycle mr-2 text-green-500"></i>
                        Form Kendaraan Baru
                    </h3>
                </div>section('title', 'Tambah Kendaraan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-plus-circle mr-3 text-4xl"></i>
                            Tambah Kendaraan
                        </h1>
                        <p class="text-orange-100 mt-2">Daftarkan kendaraan listrik Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('kendaraan.index') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-blue-500 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Form Kendaraan Baru
                    </h3>
                </div>
                
                <form method="POST" action="{{ route('kendaraan.store') }}" enctype="multipart/form-data" class="p-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="group">
                                <label for="merk" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-tag text-green-500 mr-2"></i>Merk Kendaraan
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" id="merk" name="merk" placeholder="Contoh: Yamaha, Honda, Selis" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
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
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                    <option value="">-- Pilih Jenis Kendaraan --</option>
                                    <option value="sepeda_listrik">Sepeda Listrik</option>
                                    <option value="motor_listrik">Motor Listrik</option>
                                </select>
                                @error('jenis_kendaraan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="tipe" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-cogs text-purple-500 mr-2"></i>Tipe Kendaraan
                                </label>
                                <input type="text" id="tipe" name="tipe" placeholder="Contoh: Vario 125, PCX 150"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
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
                                <input type="text" id="nomor_rangka" name="nomor_rangka" placeholder="Masukkan nomor rangka kendaraan"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                @error('nomor_rangka')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="tahun_pembelian" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-calendar text-orange-500 mr-2"></i>Tahun Pembelian
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="number" id="tahun_pembelian" name="tahun_pembelian" 
                                       min="2000" max="{{ date('Y') + 1 }}" placeholder="Contoh: {{ date('Y') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                @error('tahun_pembelian')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="tanggal_berakhir_garansi" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-shield-alt text-teal-500 mr-2"></i>Tanggal Berakhir Garansi
                                </label>
                                <input type="date" id="tanggal_berakhir_garansi" name="tanggal_berakhir_garansi"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                <p class="text-xs text-gray-500 mt-1">Opsional - untuk keperluan tracking garansi</p>
                                @error('tanggal_berakhir_garansi')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="foto" class="text-sm font-medium text-gray-600 block mb-2">
                                    <i class="fas fa-camera text-pink-500 mr-2"></i>Foto Kendaraan
                                </label>
                                <div class="relative">
                                    <input type="file" id="foto" name="foto" accept="image/*" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
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
                                class="flex-1 bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                            <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform"></i>
                            Simpan Kendaraan
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
                    <h3 class="text-lg font-semibold mb-2 text-black">Tips Pengisian Data</h3>
                    <div class="text-gray-700 text-sm space-y-1">
                        <p>• Pastikan data kendaraan yang dimasukkan akurat</p>
                        <p>• Foto kendaraan akan membantu identifikasi saat servis</p>
                        <p>• Simpan nomor rangka dengan benar untuk keperluan garansi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
