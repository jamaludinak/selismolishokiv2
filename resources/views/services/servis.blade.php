@extends('users.LandingPage.layouts.app')
@section('title', 'Service di Rumah')
@section('content')
    <section id="form" class="py-24 sm:py-16 md:py-24 isolate bg-gray-100 px-2 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-full sm:max-w-2xl">
            <div class="bg-white rounded-lg shadow-lg p-3 sm:p-6 md:p-8">
                <!-- Tombol Back -->
                <div class="flex items-center mb-3 sm:mb-4">
                    <a href="{{ route('home') }}">
                        <button"
                            class="flex items-center text-orange-600 hover:text-orange-800 transition duration-300 ease-in-out">
                            <svg class="h-5 w-5 sm:h-6 sm:w-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                            <span class="font-semibold text-xs sm:text-sm md:text-base lg:text-lg">Kembali</span>
                            </button>
                    </a>
                </div>

                <div class="text-center">
                    <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold tracking-tight text-gray-900">Formulir
                        Servis di Rumah
                    </h2>
                    <p class="mt-1 sm:mt-2 text-xs sm:text-sm md:text-base lg:text-lg text-gray-600">Isi formulir di bawah
                        ini untuk reservasi jadwal servis sepeda listrik Anda.</p>
                </div>
                <form id="reservation-form" action="{{ route('services.submit') }}" method="POST"
                    enctype="multipart/form-data" class="mx-auto mt-6 sm:mt-10 md:mt-16 max-w-full sm:max-w-xl">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-xs sm:text-sm font-semibold leading-6 text-black">Nama
                                Lengkap</label>
                            <div class="mt-1.5">
                                <input type="text" id="name" placeholder="Tulis nama lengkap anda"
                                    name="namaLengkap" required
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm">
                            </div>
                        </div>
                        <!-- Nomor Telepon -->
                        <div>
                            <label for="phone" class="block text-xs sm:text-sm font-semibold leading-6 text-black">Nomor
                                WhatsApp/Telepon</label>
                            <div class="mt-1.5">
                                <input type="text" id="phone" placeholder="Tulis nomor WA/Telp anda" name="noTelp"
                                    required
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm">
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-xs sm:text-sm font-semibold leading-6 text-black">Alamat
                                Lengkap</label>
                            <div class="mt-1.5">
                                <textarea id="address" placeholder="Tulis alamat lengkap beserta patokan rumah anda" name="alamatLengkap"
                                    rows="3" required
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm"></textarea>
                            </div>
                        </div>

                        <!-- Tombol Ambil Lokasi -->
                        <div class="sm:col-span-2">
                            <button type="button" onclick="ambilLokasi()"
                                class="mt-2 px-4 py-2 bg-orange-500 text-white rounded-md text-xs sm:text-sm">
                                Ambil Lokasi Saya
                            </button>
                            <p id="lokasi-status" class="mt-2 text-xs text-gray-600 italic">
                                Klik untuk menghitung biaya
                                perjalanan</p>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        <!-- Jenis Kerusakan -->
                        <div class="sm:col-span-2">
                            <label for="damage_type"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Jenis
                                Kerusakan</label>
                            <div class="mt-1.5">
                                <select id="damage_type" name="idJenisKerusakan" required
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm">
                                    <option value="">Pilih Jenis Kerusakan</option>
                                    @foreach ($jenisKerusakan as $kerusakan)
                                        <option value="{{ $kerusakan->id }}">{{ $kerusakan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Deskripsi Kerusakan -->
                        <div class="sm:col-span-2">
                            <label for="damage_description"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Deskripsi
                                Kerusakan</label>
                            <div class="mt-1.5">
                                <textarea id="damage_description" placeholder="Dekripsikan secara jelas kerusakan kendaraan anda" name="deskripsi"
                                    rows="4" required
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm"></textarea>
                            </div>
                        </div>

                        <!-- Input Jadwal -->
                        <div class="sm:col-span-2">
                            <label for="tanggal"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Tanggal</label>
                            <div class="mt-1.5">
                                <input type="date" name="tanggal" id="tanggal"
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm"
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
                            <div class="mt-1.5">
                                <select name="waktuMulai" id="waktuMulai"
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm"
                                    required>
                                    <option value="">Pilih Waktu Mulai</option>
                                    @for ($hour = 8; $hour <= 17; $hour++)
                                        <option value="{{ sprintf('%02d:00', $hour) }}">
                                            {{ sprintf('%02d:00', $hour) }}</option>
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
                            <div class="mt-1.5">
                                <select name="waktuSelesai" id="waktuSelesai"
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm"
                                    required>
                                    <option value="">Pilih Waktu Selesai</option>
                                    @for ($hour = 9; $hour <= 18; $hour++)
                                        <!-- Waktu selesai harus lebih dari waktu mulai -->
                                        <option value="{{ sprintf('%02d:00', $hour) }}">
                                            {{ sprintf('%02d:00', $hour) }}</option>
                                    @endfor
                                </select>
                                @error('waktuSelesai')
                                    <div class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Upload Gambar Kerusakan -->
                        <div class="sm:col-span-2">
                            <label for="damage_image"
                                class="block text-xs sm:text-sm font-semibold leading-6 text-black">Upload Gambar
                                Kerusakan</label>
                            <div class="mt-1.5">
                                <input type="file" id="damage_image" name="gambar" accept="image/*" required
                                    class="block w-full rounded-md border-0 px-2 sm:px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400 text-xs sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 sm:mt-8">
                        <button style="background-color: #ea580c" type="submit"
                            class="block w-full rounded-md px-3.5 py-2.5 text-center text-xs md:text-lg font-semibold text-white shadow-sm">Reservasi
                            Jadwal Servis
                        </button>
                    </div>

                    <!-- Elemen Loading -->
                    <div id="loading" class="hidden flex items-center justify-center mt-3 sm:mt-4">
                        <div
                            class="animate-spin rounded-full h-6 w-6 sm:h-8 sm:w-8 border-t-2 border-b-2 border-orange-600">
                        </div>
                        <span class="ml-2 text-gray-600 text-xs sm:text-sm">Memproses...</span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        // JavaScript for AJAX and SweetAlert Handling
        document.getElementById('reservation-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            const loadingElement = document.getElementById('loading');
            // Show loading element
            loadingElement.classList.remove('hidden');

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    loadingElement.classList.add('hidden');
                    if (data.success) {
                        Swal.fire({
                            title: 'Reservasi Berhasil',
                            html: 'No Resi Anda: ' + data.no_resi +
                                '<br>Simpan No Resi anda untuk melihat status servis anda!',
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


        // ambil lokasi
        function ambilLokasi() {
            const status = document.getElementById('lokasi-status');

            if (!navigator.geolocation) {
                status.textContent = "Geolocation tidak didukung.";
                return;
            }

            status.textContent = "Mengambil lokasi...";
            navigator.geolocation.getCurrentPosition(success, error);

            function success(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                const bengkelLat =
                    {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[1] ?? -6.2 }};
                const bengkelLng =
                    {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[0] ?? 106.8 }};
                const tarif = {{ \App\Models\Setting::where('key', 'tarif_per_km')->first()->value ?? 5000 }};

                const jarak = hitungJarak(userLat, userLng, bengkelLat, bengkelLng);
                const biaya = Math.ceil(jarak) * tarif;

                document.getElementById('latitude').value = userLat;
                document.getElementById('longitude').value = userLng;

                status.innerHTML = `✅ Jarak: <b>${jarak.toFixed(2)} km</b>, Biaya: <b>Rp${biaya.toLocaleString()}</b>`;
            }

            function error() {
                status.textContent = "❌ Gagal mengambil lokasi. Pastikan izin lokasi aktif.";
            }
        }

        function hitungJarak(lat1, lon1, lat2, lon2) {
            const R = 6371; // radius bumi km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(lat1 * Math.PI / 180) *
                Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }
    </script>
@endpush
