@extends('pelanggan.layouts.app')
@section('title', 'Edit Alamat')

@push('css')
<style>
    /* Ensure Leaflet maps don't overlap with sidebar */
    .leaflet-container {
        z-index: 10 !important;
    }
    
    .leaflet-control-container {
        z-index: 11 !important;
    }
    
    /* Ensure map container respects sidebar */
    #map {
        position: relative;
        z-index: 10;
    }
    
    @media (max-width: 768px) {
        .leaflet-container {
            z-index: 10 !important;
        }
    }
</style>
@endpush

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md mt-6 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Alamat</h1>

        <form method="POST" action="{{ route('alamat.update', $alamat->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Alamat -->
            <!-- bagian form -->
            <div>
                <label for="alamat" class="block text-xs sm:text-sm font-medium text-gray-700">Alamat <span
                        class="text-red-500">*</span></label>
                <textarea id="alamat" name="alamat" required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">{{ $alamat->alamat }}</textarea>
            </div>

            <div>
                <label for="longitude" class="block text-xs sm:text-sm font-medium text-gray-700"><span
                        class="text-red-500"></span></label>
                <input type="text" id="longitude" name="longitude" value="{{ $alamat->longitude }}" hidden required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>

            <div>
                <label for="latitude" class="block text-xs sm:text-sm font-medium text-gray-700"><span
                        class="text-red-500"></span></label>
                <input type="text" id="latitude" name="latitude" value="{{ $alamat->latitude }}" hidden required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>


            <!-- Ambil Lokasi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Atau ambil lokasi dari perangkat:</label>
                <button type="button" onclick="getLocationFromDevice()"
                    class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 transition mb-2">Ambil Lokasi dari
                    Device</button>
                <small class="text-gray-500 block mb-1">Klik untuk mengisi longitude & latitude dari GPS Anda secara
                    otomatis.</small>
                <div id="last-updated" class="text-sm text-gray-600 italic"></div>
            </div>

            <!-- Peta -->
            <div class="mb-4 relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Atau pilih lokasi di peta:</label>
                <div id="map" class="w-full h-64 rounded border mb-2 relative z-10"></div>
                <small class="text-gray-500">Geser pin merah ke lokasi alamat Anda, koordinat akan terisi otomatis.</small>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('profile.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 transition">Simpan</button>
            </div>
        </form>

        <div class="mt-6 text-sm text-gray-600">
            <strong>Cara mendapatkan longlat manual:</strong> Buka Google Maps, klik kanan lokasi Anda, pilih "Apa yang ada
            di sini?", lalu salin angka koordinat yang muncul.
        </div>
    </div>
@endsection

@push('js')
    <script>
        let map, marker;

        document.addEventListener('DOMContentLoaded', function() {
            const defaultLat = parseFloat('{{ $alamat->latitude }}') || -7.437347;
            const defaultLng = parseFloat('{{ $alamat->longitude }}') || 109.264502;

            map = L.map('map').setView([defaultLat, defaultLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function(e) {
                const latlng = marker.getLatLng();
                document.querySelector('input[name="latitude"]').value = latlng.lat;
                document.querySelector('input[name="longitude"]').value = latlng.lng;
            });

            window.map = map;
            window.marker = marker;
        });

        function getLocationFromDevice() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    document.querySelector('input[name="latitude"]').value = lat;
                    document.querySelector('input[name="longitude"]').value = lng;

                    if (window.marker && window.map) {
                        window.marker.setLatLng([lat, lng]);
                        window.map.setView([lat, lng], 15);
                    }

                    const now = new Date();
                    document.getElementById('last-updated').textContent = 'Lokasi diperbarui pada: ' + now
                        .toLocaleTimeString();
                }, function(error) {
                    alert('❌ Gagal mendapatkan lokasi: ' + error.message);
                });
            } else {
                alert('❌ Browser tidak mendukung geolocation.');
            }
        }
    </script>
@endpush
