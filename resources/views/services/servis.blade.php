@extends('LandingPage.layouts.app')
@section('title', 'Service di Rumah')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <section id="form" class="py-24 sm:py-16 md:py-24 isolate bg-gray-100 px-2 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-full sm:max-w-2xl px-0 sm:px-4">
            <div class="bg-white rounded-lg shadow-lg p-4 sm:p-8">
                <div class="flex items-center mb-3 sm:mb-4">
                    <a href="{{ route('home') }}">
                        <button
                            class="flex items-center text-orange-600 hover:text-orange-800 transition duration-300 ease-in-out">
                            <i class="fa fa-arrow-left h-5 w-5 mr-1"></i>
                        </button>
                    </a>
                </div>

                <div class="text-center">
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">Formulir Servis di Rumah</h2>
                    <p class="mt-2 text-sm sm:text-base text-gray-600">Isi formulir untuk reservasi servis sepeda listrik
                        Anda di rumah.</p>
                </div>

                <form id="reservation-form" action="{{ route('services.submit') }}" method="POST"
                    enctype="multipart/form-data" class="mx-auto mt-8 max-w-xl">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-black">Nama Lengkap</label>
                            <input type="text" id="name" name="namaLengkap" required placeholder="Tulis nama lengkap anda"
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-black">Nomor WA/Telp</label>
                            <input type="text" id="phone" name="noTelp" required placeholder="Tulis nomor WA/Telp anda"
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-semibold text-black">Alamat Lengkap</label>
                            <textarea id="address" name="alamatLengkap" rows="3" required
                                placeholder="Tulis alamat lengkap beserta patokan rumah anda"
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400"></textarea>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-black mb-1">Lokasi Anda</label>
                            <div class="flex flex-col gap-2">
                                <!-- Hidden latitude and longitude fields -->
                                <input type="hidden" id="latitude" name="latitude" required>
                                <input type="hidden" id="longitude" name="longitude" required>

                                <button type="button" onclick="getLocationFromDevice()"
                                    class="px-4 py-2 bg-orange-500 text-white rounded-md text-sm w-fit">Ambil Lokasi Saya
                                    Sekarang</button>
                                <div id="lokasi-status" class="text-sm text-gray-600 italic">Klik tombol atau geser pin di
                                    peta. Biaya dihitung otomatis.</div>
                                <div id="map" class="w-full h-64 rounded-md border"></div>
                                <!-- Biaya Perjalanan -->
                                <div id="biaya-perjalanan"
                                    class="mt-2 p-3 bg-blue-50 rounded-lg border border-blue-200 hidden">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-blue-800">Biaya Perjalanan:</span>
                                        <span id="biaya-perjalanan-text" class="text-sm font-bold text-blue-900">Rp 0</span>
                                    </div>
                                    <div class="text-xs text-blue-600 mt-1">
                                        <span id="jarak-text">Jarak: 0 km</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="damage_type" class="block text-sm font-semibold text-black">Jenis Kerusakan</label>
                            <select id="damage_type" name="idJenisKerusakan" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                                <option value="">Pilih Jenis Kerusakan</option>
                                @foreach ($jenisKerusakan as $kerusakan)
                                    <option value="{{ $kerusakan->id }}" data-biaya="{{ $kerusakan->biaya_estimasi }}">
                                        {{ $kerusakan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Biaya Estimasi Servis -->
                        <div class="sm:col-span-2">
                            <div id="biaya-estimasi" class="hidden">
                                <label class="block text-xs sm:text-sm font-semibold leading-6 text-black mb-2">
                                    Estimasi Perbaikan:
                                </label>
                                <div class="bg-orange-50 border border-orange-200 rounded-md p-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs sm:text-sm font-medium text-orange-800">Biaya Estimasi:</span>
                                        <span id="estimasi-biaya" class="text-xs sm:text-sm font-bold text-orange-900"></span>
                                    </div>
                                    <p class="text-xs text-orange-700 mt-1">*Estimasi ini dapat berubah setelah pemeriksaan detail oleh teknisi</p>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="damage_description" class="block text-sm font-semibold text-black">Deskripsi
                                Kerusakan</label>
                            <textarea id="damage_description" name="deskripsi" rows="4" required
                                placeholder="Deskripsikan secara jelas kerusakan kendaraan anda"
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400"></textarea>
                        </div>

                        <!-- Input Jadwal -->
                        <div class="sm:col-span-2">
                            <label for="tanggal"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Tanggal</label>
                            <div class="mt-2">
                                <input type="date" name="tanggal" id="tanggal"
                                    class="block w-full rounded-md border-0 px-3 py-2 text-xs sm:text-sm shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400"
                                    value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <div class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="waktuMulai"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Waktu
                                Mulai</label>
                            <div class="mt-2">
                                <select name="waktuMulai" id="waktuMulai"
                                    class="block w-full rounded-md border-0 px-3 py-2 text-xs sm:text-sm shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400"
                                    required>
                                    <option value="">Pilih Waktu Mulai</option>
                                    @for ($hour = 8; $hour <= 17; $hour++)
                                        <option value="{{ sprintf('%02d:00', $hour) }}">{{ sprintf('%02d:00', $hour) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('waktuMulai')
                                    <div class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="waktuSelesai"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Waktu
                                Selesai</label>
                            <div class="mt-2">
                                <select name="waktuSelesai" id="waktuSelesai"
                                    class="block w-full rounded-md border-0 px-3 py-2 text-xs sm:text-sm shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400"
                                    required>
                                    <option value="">Pilih Waktu Selesai</option>
                                    @for ($hour = 9; $hour <= 18; $hour++)
                                        <!-- Waktu selesai harus lebih dari waktu mulai -->
                                        <option value="{{ sprintf('%02d:00', $hour) }}">{{ sprintf('%02d:00', $hour) }}
                                        </option>
                                    @endfor
                                </select>
                                @error('waktuSelesai')
                                    <div class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="damage_image" class="block text-sm font-semibold text-black">Upload Gambar
                                Kerusakan</label>
                            <input type="file" id="damage_image" name="gambar" accept="image/*" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" style="background-color: #ea580c"
                            class="block w-full rounded-md px-3.5 py-2.5 text-center text-lg font-semibold text-white shadow-sm">
                            Reservasi Jadwal Servis
                        </button>
                    </div>
                    <div id="loading" class="hidden flex items-center justify-center mt-4">
                        <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-orange-600"></div>
                        <span class="ml-2 text-gray-600 text-sm">Memproses...</span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Peta
        let map, marker;
        window.addEventListener('DOMContentLoaded', () => {
            const defaultLat = -7.437347;
            const defaultLng = 109.264502;
            map = L.map('map').setView([defaultLat, defaultLng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);
            marker.on('dragend', function (e) {
                const latlng = marker.getLatLng();
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
                hitungBiaya(latlng.lat, latlng.lng);
            });
            getLocationFromDevice();
        });

        function getLocationFromDevice() {
            const status = document.getElementById('lokasi-status');
            if (navigator.geolocation) {
                status.textContent = "Mengambil lokasi...";
                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 15);
                    hitungBiaya(lat, lng);
                }, function (error) {
                    status.textContent = "❌ Gagal mendapatkan lokasi: " + error.message;
                });
            } else {
                status.textContent = "❌ Browser tidak mendukung geolocation.";
            }
        }

        function hitungBiaya(userLat, userLng) {
            const bengkelLat =
                                        {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[1] ?? -6.2 }};
            const bengkelLng =
                                        {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[0] ?? 106.8 }};
            const tarif = {{ \App\Models\Setting::where('key', 'tarif_per_km')->first()->value ?? 5000 }};
            const jarak = hitungJarak(userLat, userLng, bengkelLat, bengkelLng);
            const biaya = Math.ceil(jarak) * tarif;
            document.getElementById('lokasi-status').innerHTML =
                `✅ Jarak: <b>${jarak.toFixed(2)} km</b>, Biaya: <b>Rp${biaya.toLocaleString()}</b>`;
        }

        function hitungJarak(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(
                dLon / 2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        document.getElementById('reservation-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const loadingElement = document.getElementById('loading');
            loadingElement.classList.remove('hidden');

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    loadingElement.classList.add('hidden');
                    if (data.success) {
                        Swal.fire({
                            title: 'Reservasi Berhasil',
                            html: 'No Resi Anda: ' + data.no_resi +
                                '<br>Simpan No Resi untuk mengecek status servis Anda!',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Upload Video Tambahan',
                            cancelButtonText: 'Kembali ke Beranda'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/upload-video?no_resi=' + data.no_resi;
                            } else {
                                window.location.href = '/';
                            }
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    loadingElement.classList.add('hidden');
                    Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                    console.error('Error:', error);
                });
        });

        // Tambahan untuk menampilkan biaya perjalanan dan estimasi perbaikan
        const tarifPerKm = {{ \App\Models\Setting::where('key', 'tarif_per_km')->first()->value ?? 5000 }};
        const bengkelLat = {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[1] ?? -6.2 }};
        const bengkelLng = {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[0] ?? 106.8 }};

        function hitungBiayaPerjalanan(userLat, userLng) {
            const jarak = hitungJarak(userLat, userLng, bengkelLat, bengkelLng);
            const biaya = Math.ceil(jarak) * tarifPerKm;
            document.getElementById('jarak-text').textContent = `Jarak: ${jarak.toFixed(2)} km`;
            document.getElementById('biaya-perjalanan-text').textContent = `Rp ${biaya.toLocaleString()}`;
            document.getElementById('biaya-perjalanan').classList.remove('hidden');
        }

        // Trigger biaya perjalanan saat lokasi diubah
        function triggerBiayaPerjalanan() {
            const lat = parseFloat(document.getElementById('latitude').value);
            const lng = parseFloat(document.getElementById('longitude').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                hitungBiayaPerjalanan(lat, lng);
            }
        }

        // Trigger estimasi biaya saat jenis kerusakan dipilih
        document.getElementById('damage_type').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const biaya = parseFloat(selectedOption.dataset.biaya) || 0;
                if (biaya > 0) {
                    document.getElementById('estimasi-biaya').textContent = `Rp ${biaya.toLocaleString()}`;
                    document.getElementById('biaya-estimasi').classList.remove('hidden');
                } else {
                    document.getElementById('estimasi-biaya').textContent = 'Belum ditentukan';
                    document.getElementById('biaya-estimasi').classList.remove('hidden');
                }
            } else {
                document.getElementById('biaya-estimasi').classList.add('hidden');
            }
        });

        // Trigger biaya perjalanan saat lokasi diambil dari device atau pin digeser
        window.addEventListener('DOMContentLoaded', function () {
            // Panggil trigger saat lokasi berubah
            document.getElementById('latitude').addEventListener('change', triggerBiayaPerjalanan);
            document.getElementById('longitude').addEventListener('change', triggerBiayaPerjalanan);
        });

        // Modifikasi fungsi getLocationFromDevice dan marker dragend agar trigger biaya perjalanan
        function getLocationFromDevice() {
            const status = document.getElementById('lokasi-status');
            if (navigator.geolocation) {
                status.textContent = "Mengambil lokasi...";
                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 15);
                    hitungBiaya(lat, lng);
                    triggerBiayaPerjalanan();
                }, function (error) {
                    status.textContent = "❌ Gagal mendapatkan lokasi: " + error.message;
                });
            } else {
                status.textContent = "❌ Browser tidak mendukung geolocation.";
            }
        }
        // Modifikasi marker dragend
        window.addEventListener('DOMContentLoaded', () => {
            marker.on('dragend', function (e) {
                const latlng = marker.getLatLng();
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
                hitungBiaya(latlng.lat, latlng.lng);
                triggerBiayaPerjalanan();
            });
        });
    </script>
@endpush