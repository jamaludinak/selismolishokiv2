<div class="container mx-auto text-center py-16 px-8">
    <!-- Judul Section -->
    <h2 class="text-2xl md:text-3xl font-bold mt-4 mb-4 text-gray-900">Cek Status Perbaikan</h2>

    <!-- Paragraph Section -->
    <p class="text-sm md:text-xl text-gray-700 mb-6 md:mb-10">
        Masukkan nomor resi perbaikan Anda untuk melihat status terkini dari unit yang sedang diperbaiki.
    </p>

    <!-- Form untuk Mengecek Status -->
    <form id="status-form" class="w-full max-w-lg mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-center mb-8">
            <input type="text" name="noResi" id="noResi" placeholder="Masukkan Nomor Resi"
                class="w-full px-5 py-4 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 mb-4 md:mb-0 md:mr-4"
                required>
            <button type="submit"
                class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none transition duration-300">
                Cek Status
            </button>
        </div>
    </form>

    <!-- Accordion for Results -->
    <div id="status-result" class="w-full max-w-lg mx-auto mt-8 p-4 bg-white rounded-lg shadow-md hidden">
        <button
            class="toggle-button flex justify-between items-center w-full py-4 px-6 text-left bg-blue-500 text-white font-bold rounded-lg focus:outline-none focus:bg-blue-600"
            type="button">
            Hasil Pengecekan
            <span id="chevron" class="ml-4 transition-transform duration-300">&#x25BC;</span>
        </button>

        <div id="status-details" class="max-h-0 overflow-hidden transition-all duration-300">
            <!-- Status Summary -->
            <div id="status-summary" class="text-left p-4 text-gray-800">
                <p><strong>Status:</strong> <span id="current-status"></span></p>
                <p><strong>Nama:</strong> <span id="nama-lengkap"></span></p>
                <p><strong>No. Telp:</strong> <span id="nomor-telp"></span></p>
            </div>

            <!-- Riwayat Status Table -->
            <table class="table-auto w-full mt-4 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-gray-800">Tanggal</th>
                        <th class="p-2 text-gray-800">Jam</th>
                        <th class="p-2 text-gray-800">Status</th>
                    </tr>
                </thead>
                <tbody id="status-riwayat" class="text-gray-800">
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("status-form").addEventListener("submit", function(event) {
            event.preventDefault();

            const noResi = document.getElementById("noResi").value;

            // Tampilkan loading spinner
            Swal.fire({
                title: 'Mengecek Status...',
                text: 'Harap tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(`/cek-resi/${noResi}`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    Swal.close(); // Tutup spinner

                    if (data.success) {
                        const statusText = mapStatus(data.data.status);
                        const nama = data.data.namaLengkap;
                        const telp = data.data.noTelp;

                        // Format riwayat status
                        let riwayatHTML = "";
                        data.data.riwayat.forEach((item) => {
                            const date = new Date(item.created_at).toLocaleDateString("id-ID");
                            const time = new Date(item.created_at).toLocaleTimeString("id-ID", {
                                hour: "2-digit",
                                minute: "2-digit",
                                hour12: false,
                            });
                            const status = mapStatus(item.status);

                            riwayatHTML += `<tr>
                            <td class="p-2">${date}</td>
                            <td class="p-2">${time}</td>
                            <td class="p-2">${status}</td>
                        </tr>`;
                        });

                        // Masukkan ke tabel
                        document.getElementById("current-status").innerText = statusText;
                        document.getElementById("nama-lengkap").innerText = nama;
                        document.getElementById("nomor-telp").innerText = telp;
                        document.getElementById("status-riwayat").innerHTML = riwayatHTML;
                        document.getElementById("status-result").classList.remove("hidden");

                        // Modal ringkasan cepat
                        Swal.fire({
                            icon: 'success',
                            html: `<b>${nama}</b><br>Status: <b>${statusText}</b>`,
                            confirmButtonText: 'Lihat Detail',
                            showCancelButton: true,
                            cancelButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Scroll ke hasil
                                document.getElementById("status-result").scrollIntoView({
                                    behavior: 'smooth'
                                });
                            }
                        });

                    } else {
                        Swal.fire('Tidak Ditemukan', data.message || 'Resi tidak valid.', 'error');
                    }
                })
                .catch((error) => {
                    Swal.close();
                    console.error("Error:", error);
                    Swal.fire('Gagal', 'Terjadi kesalahan saat mengambil data.', 'error');
                });
        });

        function mapStatus(status) {
            const statusMapping = {
                pending: "Menunggu Konfirmasi",
                confirmed: "Sudah Konfirmasi",
                process: "Proses Perbaikan",
                completed: "Selesai",
                cancelled: "Dibatalkan",
            };
            return statusMapping[status] || status;
        }

        // Toggle Accordion (optional jika masih pakai accordion manual)
        document.querySelector(".toggle-button").addEventListener("click", function(event) {
            const statusDetails = document.getElementById("status-details");
            const chevron = document.getElementById("chevron");

            if (statusDetails.style.maxHeight) {
                statusDetails.style.maxHeight = null;
                chevron.style.transform = "rotate(0deg)";
            } else {
                statusDetails.style.maxHeight = statusDetails.scrollHeight + "px";
                chevron.style.transform = "rotate(180deg)";
            }
        });
    </script>
@endpush
