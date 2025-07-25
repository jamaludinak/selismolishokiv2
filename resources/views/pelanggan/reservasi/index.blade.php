@extends('pelanggan.layouts.app')
@section('title', 'Data Reservasi Servis')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Data Reservasi Servis</h1>
                    <p class="text-orange-100 mt-1">Kelola semua reservasi servis Anda</p>
                </div>
                <a href="{{ route('reservasi.create') }}"
                    class="bg-white text-orange-600 px-6 py-3 rounded-lg hover:bg-orange-50 font-semibold text-sm sm:text-base w-full sm:w-auto text-center transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Buat Reservasi
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-1"></i>Cari Reservasi
                    </label>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan No. Resi, Nama, atau Status..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                </div>
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                    <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="process">Process</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <button onclick="clearFilters()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-times mr-1"></i>Reset
                </button>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="reservasiTable">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-receipt mr-1"></i>No. Resi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-user mr-1"></i>Nama
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-tools mr-1"></i>Jenis Layanan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-calendar mr-1"></i>Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-clock mr-1"></i>Waktu
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-1"></i>Status
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-cogs mr-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                        @forelse($reservasis as $r)
                            <tr class="hover:bg-gray-50 transition-colors duration-200" data-search="{{ strtolower($r->noResi . ' ' . $r->namaLengkap . ' ' . $r->status . ' ' . $r->servis) }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-sm text-orange-600 font-semibold">{{ $r->noResi }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $r->namaLengkap }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($r->servis == 'Home Service') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $r->servis }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($r->reqJadwals && $r->reqJadwals->first())
                                        {{ \Carbon\Carbon::parse($r->reqJadwals->first()->tanggal)->format('d M Y') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($r->reqJadwals && $r->reqJadwals->first())
                                        {{ \Carbon\Carbon::parse($r->reqJadwals->first()->waktuMulai)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($r->reqJadwals->first()->waktuSelesai)->format('H:i') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClass = match($r->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'process' => 'bg-indigo-100 text-indigo-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('reservasi.show', $r->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                        @if($r->status == 'pending')
                                        <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" class="delete-form" data-entity="reservasi">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500 text-lg">Belum ada data reservasi servis.</p>
                                        <p class="text-gray-400 text-sm mt-1">Buat reservasi pertama Anda sekarang!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4" id="mobileCards">
                @forelse($reservasis as $r)
                    <div class="bg-gradient-to-r from-white to-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200" 
                         data-search="{{ strtolower($r->noResi . ' ' . $r->namaLengkap . ' ' . $r->status . ' ' . $r->servis) }}">
                        <div class="space-y-3">
                            <!-- Header with No. Resi and Status -->
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1">
                                        <i class="fas fa-receipt text-orange-500 mr-1"></i>No. Resi:
                                    </h3>
                                    <p class="text-orange-600 font-mono font-bold">{{ $r->noResi }}</p>
                                </div>
                                @php
                                    $statusClass = match($r->status) {
                                        'pending' => 'bg-yellow-500',
                                        'confirmed' => 'bg-blue-500',
                                        'process' => 'bg-indigo-500',
                                        'completed' => 'bg-green-500',
                                        'cancelled' => 'bg-red-500',
                                        default => 'bg-gray-500'
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-white text-xs font-medium {{ $statusClass }}">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </div>

                            <!-- Service Details -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-user text-gray-500 mr-1"></i>Nama:
                                    </h4>
                                    <p class="text-gray-900 text-sm">{{ $r->namaLengkap }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-tools text-gray-500 mr-1"></i>Layanan:
                                    </h4>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($r->servis == 'Home Service') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $r->servis }}
                                    </span>
                                </div>
                            </div>

                            <!-- Date & Time -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-calendar text-gray-500 mr-1"></i>Tanggal:
                                    </h4>
                                    <p class="text-gray-900 text-sm">
                                        @if($r->reqJadwals && $r->reqJadwals->first())
                                            {{ \Carbon\Carbon::parse($r->reqJadwals->first()->tanggal)->format('d M Y') }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </p>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-700 text-xs mb-1">
                                        <i class="fas fa-clock text-gray-500 mr-1"></i>Waktu:
                                    </h4>
                                    <p class="text-gray-900 text-sm">
                                        @if($r->reqJadwals && $r->reqJadwals->first())
                                            {{ \Carbon\Carbon::parse($r->reqJadwals->first()->waktuMulai)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($r->reqJadwals->first()->waktuSelesai)->format('H:i') }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                                <a href="{{ route('reservasi.show', $r->id) }}"
                                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                @if($r->status == 'pending')
                                <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" class="delete-form flex-1" data-entity="reservasi">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md text-xs font-medium transition-colors duration-200">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 text-lg">Belum ada data reservasi servis.</p>
                        <p class="text-gray-400 text-sm mt-1">Buat reservasi pertama Anda sekarang!</p>
                        <a href="{{ route('reservasi.create') }}" 
                           class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
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
                    Menampilkan <span id="showingStart">0</span> - <span id="showingEnd">0</span> dari <span id="totalItems">{{ $reservasis->count() }}</span> reservasi
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
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-orange-500"></div>
                <span class="text-gray-700">Memuat data...</span>
            </div>
        </div>
    </div>

    <script>
        class ReservasiTable {
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
                    active ? 'bg-orange-500 text-white' : 
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
                    btn.className = btn.className.replace(/(bg-orange-500 text-white|text-gray-700 hover:bg-gray-100)/, 
                        isActive ? 'bg-orange-500 text-white' : 'text-gray-700 hover:bg-gray-100');
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
                if (confirm(`Apakah Anda yakin ingin menghapus ${entity} ini?`)) {
                    form.submit();
                }
            }
        }

        // Clear filters function
        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            reservasiTable.filterData();
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.reservasiTable = new ReservasiTable();
        });
    </script>
@endsection
