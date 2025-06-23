<div class="container mx-auto text-center">
    <!-- Judul Section -->
    <h2 class="text-2xl font-bold mt-8 mb-8 text-gray-900">Cek Status Perbaikan</h2>

    <!-- Paragraph Section -->
    <p class="text-xl text-gray-700 mb-10">
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
