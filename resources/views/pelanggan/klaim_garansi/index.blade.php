@extends('pelanggan.layouts.app')

@section('title', 'Klaim Garansi')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with gradient -->
        <div class="bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-4xl"></i>
                            Daftar Klaim Garansi
                        </h1>
                        <p class="text-blue-100 mt-2">Kelola klaim garansi kendaraan Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        @if ($reservasis->isNotEmpty())
                            <div class="relative">
                                <select onchange="location = this.value;"
                                        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 appearance-none cursor-pointer pr-10">
                                    <option value="" disabled selected class="text-gray-800">+ Buat Klaim Garansi</option>
                                    @foreach ($reservasis as $res)
                                        <option value="{{ route('klaim-garansi.create', $res->noResi) }}" class="text-gray-800">
                                            {{ $res->noResi }} - {{ $res->kendaraan->kode ?? 'Tanpa Kode' }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-white"></i>
                                </div>
                            </div>
                        @endif
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
                                   placeholder="Cari klaim berdasarkan No. Resi atau deskripsi...">
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select id="statusFilter" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Semua Status</option>
                            <option value="diajukan">Diajukan</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
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
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-receipt mr-2 text-green-500"></i>No. Resi
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2 text-blue-500"></i>Tanggal Klaim
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-file-alt mr-2 text-purple-500"></i>Deskripsi
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-image mr-2 text-orange-500"></i>Bukti
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2 text-indigo-500"></i>Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-clock mr-2 text-red-500"></i>Tanggal Diproses
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                            @forelse($klaimGaransis as $k)
                                <tr class="hover:bg-gray-50 transition-colors duration-200" 
                                    data-search="{{ strtolower(($k->reservasi->noResi ?? '') . ' ' . ($k->keterangan ?? '') . ' ' . $k->status) }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <i class="fas fa-file-alt text-green-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 font-mono">{{ $k->reservasi->noResi ?? '-' }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $k->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $k->created_at->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $k->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate">
                                            {{ $k->keterangan ?? 'Tidak ada deskripsi' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($k->bukti)
                                            <a href="{{ asset($k->bukti) }}" target="_blank"
                                               class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                                                <i class="fas fa-eye mr-1"></i>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-sm">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusConfig = match ($k->status) {
                                                'diajukan' => ['bg-yellow-100 text-yellow-800', 'fas fa-clock', 'Diajukan'],
                                                'diterima' => ['bg-green-100 text-green-800', 'fas fa-check-circle', 'Diterima'],
                                                'ditolak' => ['bg-red-100 text-red-800', 'fas fa-times-circle', 'Ditolak'],
                                                default => ['bg-gray-100 text-gray-800', 'fas fa-question-circle', 'Unknown'],
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusConfig[0] }}">
                                            <i class="{{ $statusConfig[1] }} mr-1"></i>{{ $statusConfig[2] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($k->tanggal_diproses)
                                            <div class="text-sm text-gray-900">{{ $k->tanggal_diproses->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $k->tanggal_diproses->format('H:i') }}</div>
                                        @else
                                            <span class="text-gray-400 text-sm">Belum diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-shield-alt text-4xl text-gray-300 mb-3"></i>
                                            <p class="text-gray-500 text-lg">Belum ada klaim garansi.</p>
                                            <p class="text-gray-400 text-sm mt-1">Buat klaim garansi pertama Anda!</p>
                                            @if ($reservasis->isNotEmpty())
                                                <div class="mt-4">
                                                    <select onchange="location = this.value;"
                                                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200 cursor-pointer">
                                                        <option value="" disabled selected>Pilih Reservasi untuk Klaim</option>
                                                        @foreach ($reservasis as $res)
                                                            <option value="{{ route('klaim-garansi.create', $res->noResi) }}" class="text-gray-800">
                                                                {{ $res->noResi }} - {{ $res->kendaraan->kode ?? 'Tanpa Kode' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden space-y-4 p-4" id="mobileCards">
                    @forelse($klaimGaransis as $k)
                        <div class="bg-gradient-to-r from-white to-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200" 
                             data-search="{{ strtolower(($k->reservasi->noResi ?? '') . ' ' . ($k->keterangan ?? '') . ' ' . $k->status) }}">
                            <div class="space-y-3">
                                <!-- Header with No. Resi and Status -->
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-shield-alt text-green-600 text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 font-mono">{{ $k->reservasi->noResi ?? '-' }}</h3>
                                        <p class="text-sm text-gray-600">{{ $k->created_at->format('d M Y, H:i') }}</p>
                                        @php
                                            $statusConfig = match ($k->status) {
                                                'diajukan' => ['bg-yellow-100 text-yellow-800', 'fas fa-clock', 'Diajukan'],
                                                'diterima' => ['bg-green-100 text-green-800', 'fas fa-check-circle', 'Diterima'],
                                                'ditolak' => ['bg-red-100 text-red-800', 'fas fa-times-circle', 'Ditolak'],
                                                default => ['bg-gray-100 text-gray-800', 'fas fa-question-circle', 'Unknown'],
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mt-1 {{ $statusConfig[0] }}">
                                            <i class="{{ $statusConfig[1] }} mr-1"></i>{{ $statusConfig[2] }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Claim Details -->
                                <div class="grid grid-cols-1 gap-3">
                                    <div>
                                        <h4 class="font-medium text-gray-700 text-xs mb-1">
                                            <i class="fas fa-file-alt text-purple-500 mr-1"></i>Deskripsi:
                                        </h4>
                                        <p class="text-gray-900 text-sm">{{ $k->keterangan ?? 'Tidak ada deskripsi' }}</p>
                                    </div>
                                    
                                    @if($k->tanggal_diproses)
                                    <div>
                                        <h4 class="font-medium text-gray-700 text-xs mb-1">
                                            <i class="fas fa-clock text-indigo-500 mr-1"></i>Tanggal Diproses:
                                        </h4>
                                        <p class="text-gray-900 text-sm">{{ $k->tanggal_diproses->format('d M Y, H:i') }}</p>
                                    </div>
                                    @endif
                                </div>

                                <!-- Bukti Section -->
                                @if($k->bukti)
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-image text-orange-500 mr-1"></i>Bukti Klaim:
                                    </h4>
                                    <a href="{{ asset($k->bukti) }}" target="_blank"
                                       class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs font-medium transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i>
                                        Lihat Bukti
                                    </a>
                                </div>
                                @endif

                                <!-- Action Buttons (if needed) -->
                                <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                                    @if($k->bukti)
                                        <a href="{{ asset($k->bukti) }}" target="_blank"
                                           class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                            <i class="fas fa-eye mr-1"></i>Lihat Bukti
                                        </a>
                                    @endif
                                    
                                    @if($k->status === 'diajukan')
                                        <div class="flex-1 bg-yellow-100 text-yellow-800 px-3 py-2 rounded-md text-xs font-medium text-center">
                                            <i class="fas fa-clock mr-1"></i>Menunggu Proses
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-shield-alt text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 text-lg">Belum ada klaim garansi.</p>
                            <p class="text-gray-400 text-sm mt-1">Buat klaim garansi pertama Anda!</p>
                            @if ($reservasis->isNotEmpty())
                                <div class="mt-4">
                                    <select onchange="location = this.value;"
                                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200 cursor-pointer">
                                        <option value="" disabled selected>Pilih Reservasi untuk Klaim</option>
                                        @foreach ($reservasis as $res)
                                            <option value="{{ route('klaim-garansi.create', $res->noResi) }}" class="text-gray-800">
                                                {{ $res->noResi }} - {{ $res->kendaraan->kode ?? 'Tanpa Kode' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span id="showingStart">0</span> - <span id="showingEnd">0</span> dari <span id="totalItems">{{ $klaimGaransis->count() }}</span> klaim
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
        class KlaimTable {
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
            }

            filterData() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
                const statusFilter = document.getElementById('statusFilter').value.toLowerCase();

                this.filteredRows = this.allRows.filter(row => {
                    const searchData = row.getAttribute('data-search') || '';
                    const matchesSearch = searchTerm === '' || searchData.includes(searchTerm);
                    
                    let matchesStatus = true;
                    if (statusFilter) {
                        matchesStatus = searchData.includes(statusFilter);
                    }

                    return matchesSearch && matchesStatus;
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
            klaimTable.filterData();
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.klaimTable = new KlaimTable();
        });
    </script>
@endsection
