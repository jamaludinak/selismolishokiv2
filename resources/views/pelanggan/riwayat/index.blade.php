@extends('pelanggan.layouts.app')

@section('title', 'Riwayat Servis')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-history mr-3 text-4xl"></i>
                            Riwayat Reservasi
                        </h1>
                        <p class="text-orange-100 mt-2">Lihat semua riwayat layanan servis kendaraan Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('reservasi.create') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Buat Reservasi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white rounded-xl shadow-lg mb-8 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="searchInput" 
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   placeholder="Cari riwayat berdasarkan No. Resi, kendaraan, atau status...">
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select id="statusFilter" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Semua Status</option>
                            <option value="completed">Selesai</option>
                            <option value="pending">Menunggu</option>
                            <option value="in_progress">Dalam Proses</option>
                        </select>
                        
                        <select id="garansiFilter" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Semua Garansi</option>
                            <option value="aktif">Garansi Aktif</option>
                            <option value="kadaluarsa">Garansi Kadaluarsa</option>
                        </select>
                        
                        <button onclick="clearFilters()" 
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                            <i class="fas fa-eraser mr-2"></i>
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Data Container -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-receipt mr-2 text-green-500"></i>No. Resi
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2 text-blue-500"></i>Tanggal
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-motorcycle mr-2 text-purple-500"></i>Kendaraan
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-money-bill mr-2 text-orange-500"></i>Total Biaya
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2 text-indigo-500"></i>Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-shield-alt mr-2 text-red-500"></i>Garansi
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-black uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2 text-gray-500"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                            @forelse ($riwayats as $r)
                                @php
                                    $garansiAktif = $r->tanggal_berakhir_garansi && \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->isFuture();
                                    $statusGaransi = $garansiAktif ? 'aktif' : 'kadaluarsa';
                                    $totalBiaya = $r->total_harga + $r->biaya_perjalanan;
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors duration-200" 
                                    data-search="{{ strtolower($r->noResi . ' ' . $r->data_kendaraan . ' ' . $r->status . ' ' . $statusGaransi) }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <i class="fas fa-file-alt text-green-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 font-mono">{{ $r->noResi }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $r->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($r->created_at)->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $r->data_kendaraan }}</div>
                                        @if($r->kendaraan)
                                            <div class="text-sm text-gray-500">{{ $r->kendaraan->merk ?? '' }} {{ $r->kendaraan->tipe ?? '' }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</div>
                                        <div class="text-sm text-gray-500">
                                            Servis: {{ number_format($r->total_harga, 0, ',', '.') }}
                                            @if($r->biaya_perjalanan > 0)
                                                <br>Perjalanan: {{ number_format($r->biaya_perjalanan, 0, ',', '.') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($r->status === 'completed') bg-green-100 text-green-800
                                            @elseif($r->status === 'in_progress') bg-blue-100 text-blue-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            @if($r->status === 'completed') 
                                                <i class="fas fa-check-circle mr-1"></i>Selesai
                                            @elseif($r->status === 'in_progress') 
                                                <i class="fas fa-cog mr-1 animate-spin"></i>Proses
                                            @else 
                                                <i class="fas fa-clock mr-1"></i>Menunggu
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($r->tanggal_berakhir_garansi)
                                            <div class="space-y-1">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($garansiAktif) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                                    @if($garansiAktif) 
                                                        <i class="fas fa-shield-alt mr-1"></i>Aktif
                                                    @else 
                                                        <i class="fas fa-times-circle mr-1"></i>Kadaluarsa
                                                    @endif
                                                </span>
                                                <div class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->format('d M Y') }}
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Tidak ada garansi</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('riwayats.show', $r->id) }}"
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                                <i class="fas fa-eye mr-1"></i>
                                                Detail
                                            </a>
                                            @if ($r->status === 'completed' && $garansiAktif && !$r->klaimGaransi)
                                                <a href="{{ route('klaim-garansi.create', ['noResi' => $r->noResi]) }}"
                                                   class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                                    <i class="fas fa-shield-alt mr-1"></i>
                                                    Klaim
                                                </a>
                                            @elseif ($r->klaimGaransi)
                                                <span class="bg-gray-100 text-gray-600 px-3 py-2 rounded-lg text-xs flex items-center">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    Sudah Klaim
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-history text-4xl text-gray-300 mb-3"></i>
                                            <p class="text-gray-500 text-lg">Belum ada riwayat servis.</p>
                                            <p class="text-gray-400 text-sm mt-1">Buat reservasi pertama Anda sekarang!</p>
                                            <a href="{{ route('reservasi.create') }}" 
                                               class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>Buat Reservasi
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden space-y-4 p-4" id="mobileCards">
                    @forelse ($riwayats as $r)
                        @php
                            $garansiAktif = $r->tanggal_berakhir_garansi && \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->isFuture();
                            $statusGaransi = $garansiAktif ? 'aktif' : 'kadaluarsa';
                            $totalBiaya = $r->total_harga + $r->biaya_perjalanan;
                            $klaimSudahAda = $r->klaimGaransi !== null;
                        @endphp
                        <div class="bg-gradient-to-r from-white to-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200" 
                             data-search="{{ strtolower($r->noResi . ' ' . $r->data_kendaraan . ' ' . $r->status . ' ' . $statusGaransi) }}">
                            <div class="space-y-3">
                                <!-- Header with No. Resi and Status -->
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-file-alt text-green-600 text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 font-mono">{{ $r->noResi }}</h3>
                                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($r->created_at)->format('d M Y, H:i') }}</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mt-1
                                            @if($r->status === 'completed') bg-green-100 text-green-800
                                            @elseif($r->status === 'in_progress') bg-blue-100 text-blue-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            @if($r->status === 'completed') 
                                                <i class="fas fa-check-circle mr-1"></i>Selesai
                                            @elseif($r->status === 'in_progress') 
                                                <i class="fas fa-cog mr-1"></i>Proses
                                            @else 
                                                <i class="fas fa-clock mr-1"></i>Menunggu
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <!-- Service Details -->
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <h4 class="font-medium text-gray-700 text-xs mb-1">
                                            <i class="fas fa-motorcycle text-purple-500 mr-1"></i>Kendaraan:
                                        </h4>
                                        <p class="text-gray-900 text-sm">{{ $r->data_kendaraan }}</p>
                                        @if($r->kendaraan)
                                            <p class="text-gray-600 text-xs">{{ $r->kendaraan->merk ?? '' }} {{ $r->kendaraan->tipe ?? '' }}</p>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-medium text-gray-700 text-xs mb-1">
                                            <i class="fas fa-money-bill text-orange-500 mr-1"></i>Total Biaya:
                                        </h4>
                                        <p class="text-gray-900 text-sm font-semibold">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
                                        <p class="text-gray-600 text-xs">
                                            Servis: {{ number_format($r->total_harga, 0, ',', '.') }}
                                            @if($r->biaya_perjalanan > 0)
                                                <br>Perjalanan: {{ number_format($r->biaya_perjalanan, 0, ',', '.') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Warranty Status -->
                                @if($r->tanggal_berakhir_garansi)
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-shield-alt text-red-500 mr-1"></i>Status Garansi:
                                    </h4>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($garansiAktif) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                            @if($garansiAktif) 
                                                <i class="fas fa-shield-alt mr-1"></i>Aktif
                                            @else 
                                                <i class="fas fa-times-circle mr-1"></i>Kadaluarsa
                                            @endif
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                                    <a href="{{ route('riwayats.show', $r->id) }}"
                                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                    @if ($r->status === 'completed' && $garansiAktif && !$klaimSudahAda)
                                        <a href="{{ route('klaim-garansi.create', ['noResi' => $r->noResi]) }}"
                                           class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                            <i class="fas fa-shield-alt mr-1"></i>Klaim Garansi
                                        </a>
                                    @elseif ($klaimSudahAda)
                                        <div class="flex-1 bg-gray-100 text-gray-600 px-3 py-2 rounded-md text-xs font-medium text-center">
                                            <i class="fas fa-check-circle mr-1"></i>Sudah Klaim
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-history text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 text-lg">Belum ada riwayat servis.</p>
                            <p class="text-gray-400 text-sm mt-1">Buat reservasi pertama Anda sekarang!</p>
                            <a href="{{ route('reservasi.create') }}" 
                               class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Buat Reservasi
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span id="showingStart">0</span> - <span id="showingEnd">0</span> dari <span id="totalItems">{{ $riwayats->count() }}</span> riwayat
                    </div>
                    <div class="flex space-x-1" id="pagination">
                        <!-- Pagination buttons will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div id="loadingOverlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 shadow-xl">
                <div class="flex items-center space-x-3">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-500"></div>
                    <span class="text-gray-700">Memuat data...</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        class RiwayatTable {
            constructor() {
                this.currentPage = 1;
                this.itemsPerPage = 10;
                this.allRows = [];
                this.filteredRows = [];
                this.init();
            }

            init() {
                // Get all table rows and mobile cards
                this.allRows = Array.from(document.querySelectorAll('#tableBody tr, #mobileCards > div')).filter(row => {
                    return row.getAttribute('data-search');
                });
                this.filteredRows = [...this.allRows];
                
                // Setup event listeners
                this.setupEventListeners();
                
                // Initial pagination setup
                this.updatePagination();
                this.showPage(1);
            }

            setupEventListeners() {
                // Search input
                const searchInput = document.getElementById('searchInput');
                const statusFilter = document.getElementById('statusFilter');
                const garansiFilter = document.getElementById('garansiFilter');

                let searchTimeout;
                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.filterData();
                    }, 300);
                });

                statusFilter.addEventListener('change', () => {
                    this.filterData();
                });

                garansiFilter.addEventListener('change', () => {
                    this.filterData();
                });
            }

            filterData() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
                const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
                const garansiFilter = document.getElementById('garansiFilter').value.toLowerCase();

                this.filteredRows = this.allRows.filter(row => {
                    const searchData = row.getAttribute('data-search') || '';
                    const matchesSearch = searchTerm === '' || searchData.includes(searchTerm);
                    
                    let matchesStatus = true;
                    if (statusFilter) {
                        matchesStatus = searchData.includes(statusFilter);
                    }

                    let matchesGaransi = true;
                    if (garansiFilter) {
                        matchesGaransi = searchData.includes(garansiFilter);
                    }

                    return matchesSearch && matchesStatus && matchesGaransi;
                });

                this.currentPage = 1;
                this.updatePagination();
                this.showPage(1);
            }

            showPage(page) {
                this.showLoading();
                
                setTimeout(() => {
                    this.currentPage = page;
                    const startIndex = (page - 1) * this.itemsPerPage;
                    const endIndex = startIndex + this.itemsPerPage;

                    // Hide all rows
                    this.allRows.forEach(row => {
                        row.style.display = 'none';
                    });

                    // Show filtered rows for current page
                    this.filteredRows.slice(startIndex, endIndex).forEach(row => {
                        row.style.display = '';
                    });

                    // Update pagination UI
                    this.updatePaginationUI();
                    this.updateItemsInfo();
                    this.hideLoading();
                }, 200);
            }

            updatePagination() {
                const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
                const paginationContainer = document.getElementById('pagination');
                paginationContainer.innerHTML = '';

                if (totalPages <= 1) return;

                // Previous button
                const prevBtn = this.createPaginationButton('‹', this.currentPage - 1, this.currentPage === 1);
                paginationContainer.appendChild(prevBtn);

                // Page numbers
                const startPage = Math.max(1, this.currentPage - 2);
                const endPage = Math.min(totalPages, this.currentPage + 2);

                if (startPage > 1) {
                    paginationContainer.appendChild(this.createPaginationButton(1, 1));
                    if (startPage > 2) {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.className = 'px-2 py-1 text-gray-500';
                        paginationContainer.appendChild(ellipsis);
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    paginationContainer.appendChild(this.createPaginationButton(i, i, false, i === this.currentPage));
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.className = 'px-2 py-1 text-gray-500';
                        paginationContainer.appendChild(ellipsis);
                    }
                    paginationContainer.appendChild(this.createPaginationButton(totalPages, totalPages));
                }

                // Next button
                const nextBtn = this.createPaginationButton('›', this.currentPage + 1, this.currentPage === totalPages);
                paginationContainer.appendChild(nextBtn);
            }

            createPaginationButton(text, page, disabled = false, active = false) {
                const button = document.createElement('button');
                button.textContent = text;
                button.className = `px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200 ${
                    disabled ? 'text-gray-300 cursor-not-allowed' : 
                    active ? 'bg-green-500 text-white' : 
                    'text-gray-700 hover:bg-gray-100'
                }`;
                
                if (!disabled) {
                    button.addEventListener('click', () => this.showPage(page));
                }
                
                return button;
            }

            updatePaginationUI() {
                // Update active pagination button
                document.querySelectorAll('#pagination button').forEach(btn => {
                    const isActive = parseInt(btn.textContent) === this.currentPage;
                    btn.className = btn.className.replace(/(bg-green-500 text-white|text-gray-700 hover:bg-gray-100)/, 
                        isActive ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-gray-100');
                });
            }

            updateItemsInfo() {
                const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                const endIndex = Math.min(startIndex + this.itemsPerPage, this.filteredRows.length);
                
                document.getElementById('showingStart').textContent = this.filteredRows.length > 0 ? startIndex + 1 : 0;
                document.getElementById('showingEnd').textContent = endIndex;
                document.getElementById('totalItems').textContent = this.filteredRows.length;
            }

            showLoading() {
                document.getElementById('loadingOverlay').classList.remove('hidden');
                document.getElementById('loadingOverlay').classList.add('flex');
            }

            hideLoading() {
                document.getElementById('loadingOverlay').classList.add('hidden');
                document.getElementById('loadingOverlay').classList.remove('flex');
            }
        }

        // Clear filters function
        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('garansiFilter').value = '';
            riwayatTable.filterData();
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.riwayatTable = new RiwayatTable();
        });
    </script>
@endsection
