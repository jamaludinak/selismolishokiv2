@extends('pelanggan.layouts.app')
@section('title', 'Data Kendaraan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-motorcycle mr-3 text-4xl"></i>
                            Data Kendaraan
                        </h1>
                        <p class="text-orange-100 mt-2">Kelola informasi kendaraan listrik Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('kendaraan.create') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Kendaraan
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
                                   placeholder="Cari kendaraan berdasarkan merk, tipe, atau nomor rangka...">
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select id="jenisFilter" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Semua Jenis</option>
                            <option value="sepeda_listrik">Sepeda Listrik</option>
                            <option value="motor_listrik">Motor Listrik</option>
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

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Data Table Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="kendaraanTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">
                                <i class="fas fa-motorcycle mr-1"></i>Merk & Tipe
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">
                                <i class="fas fa-tag mr-1"></i>Jenis
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">
                                <i class="fas fa-barcode mr-1"></i>No. Rangka
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">
                                <i class="fas fa-calendar mr-1"></i>Tahun
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">
                                <i class="fas fa-shield-alt mr-1"></i>Status Garansi
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-black uppercase tracking-wider">
                                <i class="fas fa-cogs mr-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @forelse($kendaraans as $k)
                            @php
                                $garansiAktif = $k->tanggal_berakhir_garansi && \Carbon\Carbon::parse($k->tanggal_berakhir_garansi)->isFuture();
                                $statusGaransi = $garansiAktif ? 'aktif' : 'kadaluarsa';
                                $jenisFormatted = str_replace('_', ' ', $k->jenis_kendaraan);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-200" 
                                data-search="{{ strtolower($k->merk . ' ' . $k->tipe . ' ' . $k->nomor_rangka . ' ' . $jenisFormatted . ' ' . $statusGaransi) }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-motorcycle text-green-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $k->merk }}</div>
                                            <div class="text-sm text-gray-500">{{ $k->tipe ?: '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($k->jenis_kendaraan == 'sepeda_listrik') bg-blue-100 text-blue-800
                                        @else bg-purple-100 text-purple-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $k->jenis_kendaraan)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900 font-mono">{{ $k->nomor_rangka ?: '-' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $k->tahun_pembelian ?: '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($k->tanggal_berakhir_garansi)
                                        <div class="flex flex-col">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($garansiAktif) bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                @if($garansiAktif) 
                                                    <i class="fas fa-check-circle mr-1"></i>Aktif
                                                @else 
                                                    <i class="fas fa-times-circle mr-1"></i>Kadaluarsa
                                                @endif
                                            </span>
                                            <span class="text-xs text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($k->tanggal_berakhir_garansi)->format('d M Y') }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('kendaraan.show', $k->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                        <a href="{{ route('kendaraan.edit', $k->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="delete-form" 
                                              data-entity="kendaraan" 
                                              data-merk="{{ $k->merk }}" 
                                              data-tipe="{{ $k->tipe ?: 'Tanpa Tipe' }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-motorcycle text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500 text-lg">Belum ada data kendaraan.</p>
                                        <p class="text-gray-400 text-sm mt-1">Tambahkan kendaraan pertama Anda sekarang!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4" id="mobileCards">
                @forelse($kendaraans as $k)
                    @php
                        $garansiAktif = $k->tanggal_berakhir_garansi && \Carbon\Carbon::parse($k->tanggal_berakhir_garansi)->isFuture();
                        $statusGaransi = $garansiAktif ? 'aktif' : 'kadaluarsa';
                        $jenisFormatted = str_replace('_', ' ', $k->jenis_kendaraan);
                    @endphp
                    <div class="bg-gradient-to-r from-white to-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200" 
                         data-search="{{ strtolower($k->merk . ' ' . $k->tipe . ' ' . $k->nomor_rangka . ' ' . $jenisFormatted . ' ' . $statusGaransi) }}">
                        <div class="space-y-3">
                            <!-- Header with Vehicle Info -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-motorcycle text-green-600 text-lg"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $k->merk }}</h3>
                                    <p class="text-sm text-gray-600">{{ $k->tipe ?: 'Tanpa tipe' }}</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mt-1
                                        @if($k->jenis_kendaraan == 'sepeda_listrik') bg-blue-100 text-blue-800
                                        @else bg-purple-100 text-purple-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $k->jenis_kendaraan)) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Vehicle Details -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-barcode text-gray-500 mr-1"></i>No. Rangka:
                                    </h4>
                                    <p class="text-gray-900 text-sm font-mono">{{ $k->nomor_rangka ?: '-' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-calendar text-gray-500 mr-1"></i>Tahun:
                                    </h4>
                                    <p class="text-gray-900 text-sm">{{ $k->tahun_pembelian ?: '-' }}</p>
                                </div>
                            </div>

                            <!-- Warranty Status -->
                            <div>
                                <h4 class="font-medium text-gray-700 text-xs mb-1">
                                    <i class="fas fa-shield-alt text-gray-500 mr-1"></i>Status Garansi:
                                </h4>
                                @if($k->tanggal_berakhir_garansi)
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($garansiAktif) bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            @if($garansiAktif) 
                                                <i class="fas fa-check-circle mr-1"></i>Aktif
                                            @else 
                                                <i class="fas fa-times-circle mr-1"></i>Kadaluarsa
                                            @endif
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($k->tanggal_berakhir_garansi)->format('d M Y') }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada garansi</span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                                <a href="{{ route('kendaraan.show', $k->id) }}"
                                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                <a href="{{ route('kendaraan.edit', $k->id) }}"
                                    class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="delete-form flex-1" 
                                      data-entity="kendaraan" 
                                      data-merk="{{ $k->merk }}" 
                                      data-tipe="{{ $k->tipe ?: 'Tanpa Tipe' }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md text-xs font-medium transition-colors duration-200">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-motorcycle text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 text-lg">Belum ada data kendaraan.</p>
                        <p class="text-gray-400 text-sm mt-1">Tambahkan kendaraan pertama Anda sekarang!</p>
                        <a href="{{ route('kendaraan.create') }}" 
                           class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>Tambah Kendaraan
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                <div class="text-sm text-gray-700">
                    Menampilkan <span id="showingStart">0</span> - <span id="showingEnd">0</span> dari <span id="totalItems">{{ $kendaraans->count() }}</span> kendaraan
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

    <script>
        class KendaraanTable {
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
                const jenisFilter = document.getElementById('jenisFilter');
                const garansiFilter = document.getElementById('garansiFilter');

                let searchTimeout;
                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.filterData();
                    }, 300);
                });

                jenisFilter.addEventListener('change', () => {
                    this.filterData();
                });

                garansiFilter.addEventListener('change', () => {
                    this.filterData();
                });

                // Delete form confirmations
                document.addEventListener('submit', (e) => {
                    if (e.target.classList.contains('delete-form')) {
                        e.preventDefault();
                        this.confirmDelete(e.target);
                    }
                });
            }

            filterData() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
                const jenisFilter = document.getElementById('jenisFilter').value.toLowerCase();
                const garansiFilter = document.getElementById('garansiFilter').value.toLowerCase();

                this.filteredRows = this.allRows.filter(row => {
                    const searchData = row.getAttribute('data-search') || '';
                    const matchesSearch = searchTerm === '' || searchData.includes(searchTerm);
                    
                    let matchesJenis = true;
                    if (jenisFilter) {
                        matchesJenis = searchData.includes(jenisFilter);
                    }

                    let matchesGaransi = true;
                    if (garansiFilter) {
                        matchesGaransi = searchData.includes(garansiFilter);
                    }

                    return matchesSearch && matchesJenis && matchesGaransi;
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

            confirmDelete(form) {
                const entity = form.getAttribute('data-entity') || 'item';
                const merk = form.getAttribute('data-merk') || '';
                const tipe = form.getAttribute('data-tipe') || '';
                
                // Create detailed message
                let vehicleInfo = '';
                if (merk && tipe) {
                    vehicleInfo = `${merk} ${tipe}`;
                } else if (merk) {
                    vehicleInfo = merk;
                } else {
                    vehicleInfo = entity;
                }
                
                Swal.fire({
                    title: 'Konfirmasi Hapus Kendaraan',
                    html: `<div class="text-center">
                            <div class="mb-4">
                                <i class="fas fa-motorcycle text-6xl text-red-400"></i>
                            </div>
                            <p class="text-gray-700 mb-2">Apakah Anda yakin ingin menghapus kendaraan:</p>
                            <p class="text-lg font-bold text-gray-900 mb-4">${vehicleInfo}</p>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                <p class="text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <strong>Peringatan:</strong> Data kendaraan yang dihapus tidak dapat dikembalikan!
                                </p>
                            </div>
                           </div>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus Kendaraan!',
                    cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-xl shadow-2xl',
                        title: 'text-xl font-bold text-gray-800 mb-4',
                        content: 'text-gray-600',
                        confirmButton: 'font-medium px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200',
                        cancelButton: 'font-medium px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200'
                    },
                    buttonsStyling: true,
                    allowOutsideClick: false,
                    allowEscapeKey: true,
                    focusConfirm: false,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Menghapus Kendaraan...',
                            html: `<div class="text-center">
                                    <div class="mb-4">
                                        <i class="fas fa-trash text-4xl text-red-500 animate-pulse"></i>
                                    </div>
                                    <p class="text-gray-600">Mohon tunggu, sedang menghapus <strong>${vehicleInfo}</strong></p>
                                   </div>`,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'rounded-xl'
                            },
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Submit the form
                        form.submit();
                    }
                });
            }
        }

        // Clear filters function
        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('jenisFilter').value = '';
            document.getElementById('garansiFilter').value = '';
            kendaraanTable.filterData();
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.kendaraanTable = new KendaraanTable();
        });
    </script>
@endsection
