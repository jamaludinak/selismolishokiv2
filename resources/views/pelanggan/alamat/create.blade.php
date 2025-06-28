@extends('pelanggan.layouts.app')
@section('title', 'Tambah Alamat')

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
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md mt-2 md:mt-6 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Alamat</h1>

        <form method="POST" action="{{ route('alamat.store') }}" class="space-y-5">
            @csrf

            <!-- bagian dalam <form> -->
            <div>
                <label for="alamat" class="block text-xs sm:text-sm font-medium text-gray-700">Alamat <span
                        class="text-red-500">*</span></label>
                <textarea id="alamat" name="alamat" required
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base"></textarea>
            </div>

            <div>
                <label for="longitude" class="block text-xs sm:text-sm font-medium text-gray-700"><span
                        class="text-red-500"></span></label>
                <input type="text" id="longitude" name="longitude" hidden required placeholder="Contoh: 109.264502"
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
            </div>

            <div>
                <label for="latitude" class="block text-xs sm:text-sm font-medium text-gray-700"><span
                        class="text-red-500"></span></label>
                <input type="text" id="latitude" name="latitude" hidden required placeholder="Contoh: -7.437347"
                    class="mt-1 block w-full px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-xs sm:text-base">
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
    </div>
@endsection

@push('js')
    <script>
        let map, marker;

        document.addEventListener('DOMContentLoaded', function() {
            const defaultLat = -7.437347;
            const defaultLng = 109.264502;
            map = L.map('map').setView([defaultLat, defaultLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function() {
                const latlng = marker.getLatLng();
                document.querySelector('input[name="latitude"]').value = latlng.lat;
                document.querySelector('input[name="longitude"]').value = latlng.lng;
            });

            getLocationFromDevice(); // Default ambil lokasi saat load
        });

        function getLocationFromDevice() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    document.querySelector('input[name="latitude"]').value = lat;
                    document.querySelector('input[name="longitude"]').value = lng;

                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 15);

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
