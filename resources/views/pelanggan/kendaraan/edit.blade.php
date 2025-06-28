@extends('pelanggan.layouts.app')
@section('title', 'Edit Kendaraan')
@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md mt-6 p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Kendaraan</h1>
        <form method="POST" action="{{ route('kendaraan.update', $kendaraan->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="merk" class="block text-xs sm:text-sm font-medium text-gray-700">Merk <span
                        class="text-red-500">*</span></label>
                <input type="text" id="merk" name="merk" value="{{ $kendaraan->merk }}" required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>

            <div>
                <label for="jenis_kendaraan" class="block text-xs sm:text-sm font-medium text-gray-700">Jenis Kendaraan
                    <span class="text-red-500">*</span></label>
                <select id="jenis_kendaraan" name="jenis_kendaraan" required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="sepeda_listrik" {{ $kendaraan->jenis_kendaraan == 'sepeda_listrik' ? 'selected' : '' }}>
                        Sepeda Listrik</option>
                    <option value="motor_listrik" {{ $kendaraan->jenis_kendaraan == 'motor_listrik' ? 'selected' : '' }}>
                        Motor Listrik</option>
                </select>
            </div>

            <div>
                <label for="tipe" class="block text-xs sm:text-sm font-medium text-gray-700">Tipe</label>
                <input type="text" id="tipe" name="tipe" value="{{ $kendaraan->tipe }}"
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>

            <div>
                <label for="nomor_rangka" class="block text-xs sm:text-sm font-medium text-gray-700">Nomor Rangka</label>
                <input type="text" id="nomor_rangka" name="nomor_rangka" value="{{ $kendaraan->nomor_rangka }}"
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>

            <div>
                <label for="tahun_pembelian" class="block text-xs sm:text-sm font-medium text-gray-700">Tahun Pembelian
                    <span class="text-red-500">*</span></label>
                <input type="number" id="tahun_pembelian" name="tahun_pembelian" min="2000" max="{{ date('Y') + 1 }}"
                    value="{{ $kendaraan->tahun_pembelian }}" required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>

            <div>
                <label for="status_garansi" class="block text-xs sm:text-sm font-medium text-gray-700">Status Garansi
                    <span class="text-red-500">*</span></label>
                <select id="status_garansi" name="status_garansi" required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif" {{ $kendaraan->status_garansi == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak_aktif" {{ $kendaraan->status_garansi == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('kendaraan.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-xs sm:text-sm">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 text-xs sm:text-sm">Simpan</button>
            </div>
        </form>
    </div>
@endsection
