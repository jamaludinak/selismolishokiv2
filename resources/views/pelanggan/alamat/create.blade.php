<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alamat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-white rounded shadow p-8 mt-10">
        <h1 class="text-2xl font-bold mb-6">Tambah Alamat</h1>
        <form method="POST" action="{{ route('alamat.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-500">*</span></label>
                <textarea name="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Longitude <span class="text-red-500">*</span></label>
                <input type="text" name="longitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <small class="text-gray-500">Contoh: 109.264502</small>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Latitude <span class="text-red-500">*</span></label>
                <input type="text" name="latitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <small class="text-gray-500">Contoh: -7.437347</small>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Atau ambil lokasi dari device:</label>
                <button type="button" onclick="getLocationFromDevice()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mb-2">Ambil Lokasi Saya Sekarang</button>
                <small class="text-gray-500 block mb-1">Klik untuk mengisi longitude & latitude otomatis dari GPS HP/PC Anda. Ini juga akan mengembalikan pin ke lokasi Anda.</small>
                <div id="last-updated" class="text-sm text-gray-600 italic"></div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Atau pilih lokasi di peta:</label>
                <div id="map" class="w-full h-64 rounded border mb-2"></div>
                <small class="text-gray-500">Geser pin merah ke lokasi alamat Anda, longitude & latitude akan terisi otomatis.</small>
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('alamat.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
        <div class="mt-4 text-sm text-gray-600">
            <b>Cara mendapatkan longlat:</b> Buka Google Maps, klik kanan lokasi, pilih "What's here?", lalu copy angka longitude dan latitude.
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    let map, marker;

    document.addEventListener('DOMContentLoaded', function() {
        const defaultLat = -7.437347;
        const defaultLng = 109.264502;
        map = L.map('map').setView([defaultLat, defaultLng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        marker.on('dragend', function(e) {
            const latlng = marker.getLatLng();
            document.querySelector('input[name="latitude"]').value = latlng.lat;
            document.querySelector('input[name="longitude"]').value = latlng.lng;
        });

        // Simpan global
        window.map = map;
        window.marker = marker;

        // Ambil lokasi saat pertama kali load
        getLocationFromDevice();
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

                // Tampilkan waktu terakhir diperbarui
                const now = new Date();
                document.getElementById('last-updated').textContent = 'Lokasi diperbarui pada: ' + now.toLocaleTimeString();
            }, function(error) {
                alert('Gagal mendapatkan lokasi: ' + error.message);
            });
        } else {
            alert('Browser tidak mendukung geolocation.');
        }
    }
    </script>
</body>
</html>
