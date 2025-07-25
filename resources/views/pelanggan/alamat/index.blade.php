@extends('layouts.app')

@section('title', 'Data Alamat')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with gradient -->
        <div class="bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-4xl"></i>
                            Data Alamat
                        </h1>
                        <p class="text-blue-100 mt-2">Kelola alamat-alamat Anda dengan mudah</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('alamat.create') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Alamat Baru
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
                                   placeholder="Cari alamat...">
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
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

            <!-- Data Container -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-home mr-2 text-green-500"></i>Alamat
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-compass mr-2 text-blue-500"></i>Koordinat
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-map mr-2 text-purple-500"></i>Lokasi
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2 text-orange-500"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                            @forelse($alamats as $a)
                                <tr class="hover:bg-gray-50 transition-colors duration-200" 
                                    data-search="{{ strtolower($a->alamat . ' ' . $a->latitude . ' ' . $a->longitude) }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <i class="fas fa-home text-green-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $a->alamat }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-mono">
                                            <div>Lat: {{ $a->latitude }}</div>
                                            <div>Lng: {{ $a->longitude }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="showMap({{ $a->latitude }}, {{ $a->longitude }})"
                                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            Lihat Lokasi
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('alamat.edit', $a->id) }}"
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" class="delete-form" data-entity="alamat">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-map-marker-alt text-4xl text-gray-300 mb-3"></i>
                                            <p class="text-gray-500 text-lg">Belum ada data alamat.</p>
                                            <p class="text-gray-400 text-sm mt-1">Tambahkan alamat pertama Anda sekarang!</p>
                                            <a href="{{ route('alamat.create') }}" 
                                               class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>Tambah Alamat
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
                    @forelse($alamats as $a)
                        <div class="bg-gradient-to-r from-white to-gray-50 rounded-lg p-4 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200" 
                             data-search="{{ strtolower($a->alamat . ' ' . $a->latitude . ' ' . $a->longitude) }}">
                            <div class="space-y-3">
                                <!-- Header with Address Icon -->
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-home text-green-600 text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900">Alamat</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $a->alamat }}</p>
                                    </div>
                                </div>

                                <!-- Coordinates -->
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <h4 class="font-medium text-gray-700 text-xs mb-2">
                                        <i class="fas fa-compass text-blue-500 mr-1"></i>Koordinat:
                                    </h4>
                                    <div class="text-sm font-mono text-gray-900 space-y-1">
                                        <div>Latitude: {{ $a->latitude }}</div>
                                        <div>Longitude: {{ $a->longitude }}</div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                                    <button onclick="showMap({{ $a->latitude }}, {{ $a->longitude }})"
                                            class="flex-1 bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Lokasi
                                    </button>
                                    <a href="{{ route('alamat.edit', $a->id) }}"
                                       class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-xs font-medium text-center transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" class="delete-form flex-1" data-entity="alamat">
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
                            <i class="fas fa-map-marker-alt text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 text-lg">Belum ada data alamat.</p>
                            <p class="text-gray-400 text-sm mt-1">Tambahkan alamat pertama Anda sekarang!</p>
                            <a href="{{ route('alamat.create') }}" 
                               class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Tambah Alamat
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span id="showingStart">0</span> - <span id="showingEnd">0</span> dari <span id="totalItems">{{ $alamats->count() }}</span> alamat
                    </div>
                    <div class="flex space-x-1" id="pagination">
                        <!-- Pagination buttons will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Modal -->
        <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
                <div class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-black flex items-center">
                        <i class="fas fa-map mr-2 text-green-500"></i>
                        Lokasi pada Peta
                    </h3>
                    <button onclick="closeMap()" class="text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <div id="mapFrame" class="w-full h-96"></div>
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
        class AlamatTable {
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

                let searchTimeout;
                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.filterData();
                    }, 300);
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

                this.filteredRows = this.allRows.filter(row => {
                    const searchData = row.getAttribute('data-search') || '';
                    return searchTerm === '' || searchData.includes(searchTerm);
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
                if (confirm(`Apakah Anda yakin ingin menghapus ${entity} ini?`)) {
                    form.submit();
                }
            }
        }

        // Map functions
        function showMap(lat, lng) {
            const url = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
            document.getElementById('mapFrame').innerHTML =
                `<iframe src="${url}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
            document.getElementById('mapModal').classList.remove('hidden');
            document.getElementById('mapModal').classList.add('flex');
        }

        function closeMap() {
            document.getElementById('mapModal').classList.add('hidden');
            document.getElementById('mapModal').classList.remove('flex');
            document.getElementById('mapFrame').innerHTML = '';
        }

        // Clear filters function
        function clearFilters() {
            document.getElementById('searchInput').value = '';
            alamatTable.filterData();
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.alamatTable = new AlamatTable();
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMap();
            }
        });
    </script>
@endsection
