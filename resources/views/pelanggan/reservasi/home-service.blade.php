<section id="form" class="px-2 sm:px-6 lg:px-4">
    <div class="container mx-auto max-w-full sm:max-w-2xl px-0 sm:px-4">
        <div class="bg-white rounded-lg p-4 sm:p-8">

            <div class="text-center">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">Formulir Servis di Rumah</h2>
                <p class="mt-2 text-sm sm:text-base text-gray-600">Isi formulir untuk reservasi servis sepeda listrik
                    Anda di rumah.</p>
            </div>

            <form id="home-reservation-form" action="{{ route('reservasi.store.home') }}" method="POST"
                enctype="multipart/form-data" class="mx-auto mt-8 max-w-xl">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Pilih Alamat -->
                    <div class="sm:col-span-2">
                        <label for="alamat_id" class="block text-sm font-semibold text-black">Pilih Alamat</label>
                        <div class="mt-2">
                            <select name="alamat_id" id="alamat_id" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400 min-h-[44px] address-select">
                                <option value="">Pilih salah satu alamat</option>
                                @foreach ($alamatList as $alamat)
                                    <option value="{{ $alamat->id }}" data-lat="{{ $alamat->latitude }}"
                                        data-lng="{{ $alamat->longitude }}" data-alamat="{{ $alamat->alamat }}">
                                        {{ Str::limit($alamat->alamat, 80, '...') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Alamat Terpilih (Preview) -->
                        <div id="alamat-preview"
                            class="mt-2 p-3 bg-gray-50 rounded-lg border border-gray-200 hidden address-preview">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs font-medium text-gray-600 block mb-1">Alamat Terpilih:</span>
                                    <span id="alamat-text"
                                        class="text-sm text-gray-800 break-words leading-relaxed address-text"></span>
                                </div>
                                <button type="button" id="ubah-alamat"
                                    class="ml-2 text-xs text-orange-600 hover:text-orange-800 font-medium">
                                    Ubah
                                </button>
                            </div>
                        </div>

                        <!-- Biaya Perjalanan -->
                        <div id="biaya-perjalanan" class="mt-2 p-3 bg-blue-50 rounded-lg border border-blue-200 hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-blue-800">Biaya Perjalanan:</span>
                                <span id="biaya-perjalanan-text" class="text-sm font-bold text-blue-900">Rp 0</span>
                            </div>
                            <div class="text-xs text-blue-600 mt-1">
                                <span id="jarak-text">Jarak: 0 km</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pilih Kendaraan -->
                    <div class="sm:col-span-2">
                        <label for="kendaraan_id" class="block text-sm font-semibold text-black">Pilih Kendaraan</label>
                        <div class="mt-2">
                            <select name="kendaraan_id" id="kendaraan_id" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                                <option value="">Pilih salah satu kendaraan</option>
                                @foreach ($kendaraanList as $kendaraan)
                                    <option value="{{ $kendaraan->id }}">
                                        {{ $kendaraan->merk }} - {{ $kendaraan->tipe }}
                                        ({{ $kendaraan->tahun_pembelian }})
                                    </option>
                                @endforeach
                            </select>
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
                    <div class="sm:col-span-2">
                        <div id="estimasi-container" class="hidden">
                            <label class="block text-sm font-semibold text-black mb-2">Estimasi Perbaikan</label>
                            <div class="bg-orange-50 border border-orange-200 rounded-md p-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-orange-800">Biaya Estimasi:</span>
                                    <span id="estimasi-biaya" class="text-sm font-bold text-orange-900"></span>
                                </div>
                                <p class="text-xs text-orange-700 mt-1">*Estimasi ini dapat berubah setelah pemeriksaan
                                    detail oleh teknisi</p>
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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfigurasi bengkel
        const bengkelLat = {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[1] ?? -6.2 }};
        const bengkelLng = {{ explode(',', \App\Models\Setting::where('key', 'bengkel_longlat')->first()->value)[0] ?? 106.8 }};
        const tarifPerKm = {{ \App\Models\Setting::where('key', 'tarif_per_km')->first()->value ?? 5000 }};

        // Event listeners
        document.getElementById('alamat_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const lat = parseFloat(selectedOption.dataset.lat);
                const lng = parseFloat(selectedOption.dataset.lng);
                const alamatLengkap = selectedOption.dataset.alamat;

                // Tampilkan preview alamat
                tampilkanPreviewAlamat(alamatLengkap);

                // Hitung biaya perjalanan
                hitungBiayaPerjalanan(lat, lng);
            } else {
                // Sembunyikan preview dan biaya perjalanan
                document.getElementById('alamat-preview').classList.add('hidden');
                document.getElementById('biaya-perjalanan').classList.add('hidden');
            }
        });

        // Event listener untuk tombol "Ubah" alamat
        document.getElementById('ubah-alamat').addEventListener('click', function () {
            document.getElementById('alamat-preview').classList.add('hidden');
            document.getElementById('alamat_id').focus();
        });

        function tampilkanPreviewAlamat(alamat) {
            const previewElement = document.getElementById('alamat-preview');
            const alamatTextElement = document.getElementById('alamat-text');

            alamatTextElement.textContent = alamat;
            previewElement.classList.remove('hidden');
        }

        document.getElementById('damage_type').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const biaya = parseFloat(selectedOption.dataset.biaya) || 0;
                if (biaya > 0) {
                    document.getElementById('estimasi-biaya').textContent = `Rp ${biaya.toLocaleString()}`;
                    document.getElementById('estimasi-container').classList.remove('hidden');
                } else {
                    document.getElementById('estimasi-biaya').textContent = 'Belum ditentukan';
                    document.getElementById('estimasi-container').classList.remove('hidden');
                }
            } else {
                document.getElementById('estimasi-container').classList.add('hidden');
            }
        });

        function hitungBiayaPerjalanan(userLat, userLng) {
            const jarak = hitungJarak(userLat, userLng, bengkelLat, bengkelLng);
            const biaya = Math.ceil(jarak) * tarifPerKm;

            document.getElementById('jarak-text').textContent = `Jarak: ${jarak.toFixed(2)} km`;
            document.getElementById('biaya-perjalanan-text').textContent = `Rp ${biaya.toLocaleString()}`;
            document.getElementById('biaya-perjalanan').classList.remove('hidden');
        }

        function hitungJarak(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon / 2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        document.getElementById('home-reservation-form').addEventListener('submit', function (e) {
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
                            confirmButtonText: 'Lihat Riwayat Reservasi'
                        }).then((result) => {
                            // Redirect to reservasi index for authenticated pelanggan
                            window.location.href = '{{ route("reservasi.index") }}';
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
    </script>
@endpush

@push('css')
    <style>
        /* Custom styles for address display */
        .address-select {
            max-width: 100%;
            word-wrap: break-word;
        }

        .address-select option {
            padding: 8px 12px;
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.4;
        }

        .address-preview {
            max-width: 100%;
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }

        .address-text {
            display: block;
            line-height: 1.5;
            white-space: pre-wrap;
            word-break: break-word;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .address-select option {
                font-size: 14px;
                padding: 10px 12px;
            }

            .address-preview {
                padding: 12px;
            }

            .address-text {
                font-size: 14px;
            }
        }

        /* Ensure select dropdown is properly sized */
        select#alamat_id {
            min-height: 44px;
            max-height: 200px;
        }

        /* Custom scrollbar for long address lists */
        select#alamat_id::-webkit-scrollbar {
            width: 8px;
        }

        select#alamat_id::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        select#alamat_id::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        select#alamat_id::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
@endpush