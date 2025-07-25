<section id="form" class="px-2 sm:px-6 lg:px-4">
    <div class="container mx-auto max-w-full sm:max-w-2xl px-0 sm:px-4">
        <div class="rounded-lg p-4 sm:p-8">
            <div class="text-center mb-6">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900">Formulir Servis di Bengkel</h2>
                <p class="mt-2 text-sm sm:text-base text-gray-600">Isi formulir untuk reservasi servis sepeda listrik
                    Anda di bengkel.</p>
            </div>
            <form id="garage-reservation-form" action="{{ route('reservasi.store.garage') }}" method="POST"
                enctype="multipart/form-data" class="mx-auto mt-8 max-w-xl">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
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

                    <!-- Jenis Kerusakan -->
                    <div class="sm:col-span-2">
                        <label for="garage_damage_type" class="block text-sm font-semibold text-black">Jenis
                            Kerusakan</label>
                        <div class="mt-2">
                            <select id="garage_damage_type" name="idJenisKerusakan" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                                <option value="">Pilih Jenis Kerusakan</option>
                                @foreach ($jenisKerusakan as $kerusakan)
                                    <option value="{{ $kerusakan->id }}" data-biaya="{{ $kerusakan->biaya_estimasi }}">{{ $kerusakan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Estimasi Perbaikan -->
                    <div class="sm:col-span-2">
                        <div id="garage_estimasi_container" class="hidden">
                            <label class="block text-sm font-semibold text-black mb-2">Estimasi Perbaikan</label>
                            <div class="bg-orange-50 border border-orange-200 rounded-md p-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-orange-800">Biaya Estimasi:</span>
                                    <span id="garage_estimasi_biaya" class="text-sm font-bold text-orange-900"></span>
                                </div>
                                <p class="text-xs text-orange-700 mt-1">*Estimasi ini dapat berubah setelah pemeriksaan detail oleh teknisi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Kerusakan -->
                    <div class="sm:col-span-2">
                        <label for="damage_description" class="block text-sm font-semibold text-black">Deskripsi
                            Kerusakan</label>
                        <div class="mt-2">
                            <textarea id="damage_description" placeholder="Dekripsikan secara jelas kerusakan kendaraan anda" name="deskripsi"
                                rows="4" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400"></textarea>
                        </div>
                    </div>

                    <!-- Upload Gambar Kerusakan -->
                    <div class="sm:col-span-2">
                        <label for="damage_image" class="block text-sm font-semibold text-black">Upload Gambar
                            Kerusakan</label>
                        <div class="mt-2">
                            <input type="file" id="damage_image" name="gambar" accept="image/*" required
                                class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
                        </div>
                    </div>
                </div>
                <div class="mt-6 sm:mt-8">
                    <button style="background-color: #ea580c" type="submit"
                        class="block w-full rounded-md px-3.5 py-2.5 text-center text-xs md:text-lg font-semibold text-white shadow-sm">Reservasi
                        Jadwal Servis</button>
                </div>

                <!-- Elemen Loading -->
                <div id="loading" class="hidden flex items-center justify-center mt-4">
                    <div
                        class="animate-spin rounded-full h-6 w-6 sm:h-8 sm:w-8 border-t-2 border-b-2 border-orange-600">
                    </div>
                    <span class="ml-2 text-gray-600 text-xs sm:text-sm">Memproses...</span>
                </div>
            </form>
        </div>
    </div>
</section>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to format currency
        function formatCurrency(amount) {
            if (!amount || amount == 0) return 'Belum ditentukan';
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        }

        // Function to handle damage type selection and show estimate
        function handleGarageDamageTypeChange() {
            const damageTypeSelect = document.getElementById('garage_damage_type');
            const estimasiContainer = document.getElementById('garage_estimasi_container');
            const estimasiBiaya = document.getElementById('garage_estimasi_biaya');
            
            console.log('Garage damage type changed'); // Debug log
            
            const selectedOption = damageTypeSelect.options[damageTypeSelect.selectedIndex];
            const biaya = selectedOption.getAttribute('data-biaya');
            
            console.log('Selected biaya:', biaya); // Debug log
            
            if (biaya && biaya !== 'null' && biaya !== '' && biaya !== '0') {
                estimasiBiaya.textContent = formatCurrency(parseInt(biaya));
                estimasiContainer.classList.remove('hidden');
                console.log('Showing estimasi container'); // Debug log
            } else {
                estimasiContainer.classList.add('hidden');
                console.log('Hiding estimasi container'); // Debug log
            }
        }

        // Add event listener to damage type select - use DOMContentLoaded to ensure element exists
        document.addEventListener('DOMContentLoaded', function() {
            const garageSelect = document.getElementById('garage_damage_type');
            if (garageSelect) {
                garageSelect.addEventListener('change', handleGarageDamageTypeChange);
            }
        });

        // JavaScript for AJAX and SweetAlert Handling
        document.getElementById('garage-reservation-form').addEventListener('submit', function(e) {
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
                            cancelButtonText: 'Lihat Riwayat Reservasi'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("pelanggan.upload.video.form") }}?no_resi=' + data.no_resi;
                            } else {
                                // Redirect to riwayat index for authenticated pelanggan
                                window.location.href = '{{ route("riwayats.index") }}';
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
    </script>
@endpush
