@extends('layouts.admin')

@section('title', 'Kelola Klaim Garansi')

@push('styles')
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    /* Custom animations and hover effects */
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .search-container {
        position: relative;
    }
    
    .search-container::before {
        content: '\f002';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
        z-index: 10;
    }
    
    .search-input {
        padding-left: 40px;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .gradient-border {
        background: linear-gradient(45deg, #f97316, #ea580c);
        padding: 2px;
        border-radius: 8px;
    }
    
    .gradient-border-inner {
        background: white;
        border-radius: 6px;
    }
    
    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #f97316;
        border-radius: 3px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #ea580c;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-white mb-2">Kelola Klaim Garansi</h2>
                <p class="text-orange-100">Kelola klaim garansi dari pelanggan</p>
            </div>
            <div class="mt-4 sm:mt-0 flex items-center space-x-2">
                <span class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 text-white text-sm font-medium rounded-lg">
                    <i class="fas fa-file-alt mr-2"></i>
                    Total: {{ $klaimGaransis->total() }} Klaim
                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md hidden" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md hidden" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Terjadi kesalahan:</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Search and Filter Controls -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6 animate-fade-in">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search mr-1 text-orange-500"></i> Cari Klaim
                </label>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan no resi, nama pelanggan..." 
                           class="search-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                </div>
            </div>
            <div class="sm:w-48">
                <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-filter mr-1 text-green-500"></i> Filter Status
                </label>
                <select id="statusFilter" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white">
                    <option value="">Semua Status</option>
                    <option value="diajukan">Diajukan</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
            <div class="sm:w-48">
                <label for="entriesPerPage" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-list mr-1 text-orange-500"></i> Items per halaman
                </label>
                <select id="entriesPerPage" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
        
        <!-- Data Info -->
        <div class="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center text-sm text-gray-600">
            <div id="dataInfo" class="mb-2 sm:mb-0">
                <span id="showingText" class="font-medium">Menampilkan 0 dari 0 entri</span>
                <span id="filteredText" class="ml-2 text-orange-600 hidden font-medium">(difilter dari <span id="totalEntries">0</span> total entri)</span>
            </div>
            <div id="clearFilters" class="hidden">
                <button onclick="clearAllFilters()" class="inline-flex items-center text-orange-600 hover:text-orange-800 font-medium transition duration-200">
                    <i class="fas fa-times mr-1"></i> Hapus Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Desktop Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block animate-fade-in custom-scrollbar">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-orange-500 to-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                        <div class="flex items-center">
                            <i class="fas fa-receipt mr-2"></i>
                            No Resi
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                        <div class="flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Pelanggan
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Tanggal Ajuan
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Status
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Tanggal Diproses
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-white uppercase tracking-wider">
                        <i class="fas fa-cogs mr-2"></i>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div id="mobileCards" class="grid grid-cols-1 gap-6 md:hidden animate-fade-in">
        <!-- Cards will be populated by JavaScript -->
    </div>

    <!-- No Data Message -->
    <div id="noDataMessage" class="bg-white rounded-lg shadow-lg p-8 text-center hidden">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-file-alt text-6xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada data ditemukan</h3>
        <p class="text-gray-500" id="noDataText">Tidak ada klaim garansi yang sesuai dengan pencarian Anda.</p>
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" class="mt-6 hidden animate-fade-in">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-700">
                        <span class="font-medium text-orange-600">Menampilkan</span> 
                        <span id="startEntry" class="font-bold text-gray-900">0</span> 
                        <span class="text-gray-500">sampai</span> 
                        <span id="endEntry" class="font-bold text-gray-900">0</span> 
                        <span class="text-gray-500">dari</span> 
                        <span id="totalEntriesFooter" class="font-bold text-gray-900">0</span> 
                        <span class="text-gray-500">entri</span>
                    </p>
                </div>
                <nav class="flex items-center space-x-1" id="paginationNav">
                    <!-- Pagination buttons will be generated by JavaScript -->
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Hidden data for JavaScript -->

@endsection

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Global variables
let klaimData = {!! json_encode($klaimGaransis) !!};
let filteredData = [];
let currentPage = 1;
let itemsPerPage = 10;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize data
    filteredData = [...klaimData.data];
    renderData();
    setupEventListeners();
    
    // Check for success messages
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#f97316',
            confirmButtonText: '<i class="fas fa-check mr-2"></i>OK',
            customClass: {
                popup: 'rounded-lg shadow-2xl',
                title: 'text-lg font-semibold text-gray-800',
                confirmButton: 'bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg px-6 py-3 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105'
            },
            buttonsStyling: false
        });
    @endif
    
    // Check for error messages
    @if($errors->any())
        Swal.fire({
            title: 'Oops!',
            html: `
                <div class="text-left">
                    <p class="mb-3">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            `,
            icon: 'error',
            confirmButtonColor: '#ef4444',
            confirmButtonText: '<i class="fas fa-exclamation-triangle mr-2"></i>OK',
            customClass: {
                popup: 'rounded-lg shadow-2xl',
                title: 'text-lg font-semibold text-gray-800',
                confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg px-6 py-3 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105'
            },
            buttonsStyling: false
        });
    @endif
});

function setupEventListeners() {
    // Search input
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', debounce(handleSearch, 300));
    
    // Status filter
    const statusFilter = document.getElementById('statusFilter');
    statusFilter.addEventListener('change', handleFilters);
    
    // Items per page selector
    const entriesPerPage = document.getElementById('entriesPerPage');
    entriesPerPage.addEventListener('change', handleEntriesPerPageChange);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function handleSearch() {
    handleFilters();
}

function handleFilters() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    
    filteredData = klaimData.data.filter(item => {
        const noResi = item.reservasi?.noResi || item.reservasi?.no_resi || '';
        const namaPelanggan = item.data_pelanggan?.nama || item.reservasi?.nama || '';
        
        const matchesSearch = searchTerm === '' || 
                            noResi.toLowerCase().includes(searchTerm) ||
                            namaPelanggan.toLowerCase().includes(searchTerm);
        
        const matchesStatus = statusFilter === '' || item.status === statusFilter;
        
        return matchesSearch && matchesStatus;
    });
    
    // Show/hide clear filters button
    const hasFilters = searchTerm !== '' || statusFilter !== '';
    if (hasFilters) {
        document.getElementById('clearFilters').classList.remove('hidden');
        document.getElementById('filteredText').classList.remove('hidden');
        document.getElementById('totalEntries').textContent = klaimData.data.length;
    } else {
        document.getElementById('clearFilters').classList.add('hidden');
        document.getElementById('filteredText').classList.add('hidden');
    }
    
    currentPage = 1;
    renderData();
}

function clearAllFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filteredData = [...klaimData.data];
    document.getElementById('clearFilters').classList.add('hidden');
    document.getElementById('filteredText').classList.add('hidden');
    currentPage = 1;
    renderData();
}

function handleEntriesPerPageChange() {
    itemsPerPage = parseInt(document.getElementById('entriesPerPage').value);
    currentPage = 1;
    renderData();
}

function renderData() {
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
    const currentPageData = filteredData.slice(startIndex, endIndex);
    
    // Update data info
    updateDataInfo(totalItems, startIndex, endIndex);
    
    if (totalItems === 0) {
        showNoDataMessage();
        hidePagination();
    } else {
        hideNoDataMessage();
        renderTable(currentPageData, startIndex);
        renderMobileCards(currentPageData, startIndex);
        renderPagination(totalPages);
    }
}

function updateDataInfo(totalItems, startIndex, endIndex) {
    const showingText = document.getElementById('showingText');
    if (totalItems === 0) {
        showingText.textContent = 'Tidak ada entri yang ditampilkan';
    } else {
        showingText.textContent = `Menampilkan ${startIndex + 1} sampai ${endIndex} dari ${totalItems} entri`;
    }
}

function getStatusBadge(status) {
    if (status === 'diajukan') {
        return `<span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    <i class="fas fa-clock mr-1"></i> Diajukan
                </span>`;
    } else if (status === 'diterima') {
        return `<span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    <i class="fas fa-check mr-1"></i> Diterima
                </span>`;
    } else {
        return `<span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                    <i class="fas fa-times mr-1"></i> Ditolak
                </span>`;
    }
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function renderTable(data, startIndex) {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';
    
    data.forEach((item, index) => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50 transition duration-150';
        
        const actionButtons = item.status === 'diajukan' ? `
            <button type="button" 
                    class="inline-flex items-center px-2.5 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-md hover:bg-green-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-green-300"
                    onclick="showApprovalAlert(${item.id}, '${item.reservasi?.noResi || item.reservasi?.no_resi || '-'}', '${item.data_pelanggan?.nama || item.reservasi?.nama || 'Pelanggan'}')">
                <i class="fas fa-check text-xs mr-1"></i> Setuju
            </button>
            
            <button type="button" 
                    class="inline-flex items-center px-2.5 py-1.5 bg-red-100 text-red-700 text-xs font-medium rounded-md hover:bg-red-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-red-300 ml-1"
                    onclick="showRejectionAlert(${item.id}, '${item.reservasi?.noResi || item.reservasi?.no_resi || '-'}', '${item.data_pelanggan?.nama || item.reservasi?.nama || 'Pelanggan'}')">
                <i class="fas fa-times text-xs mr-1"></i> Tolak
            </button>
        ` : '';
        
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-100 text-orange-800 text-xs font-bold rounded-full">
                    ${startIndex + index + 1}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex items-center">
                    <i class="fas fa-receipt text-orange-500 mr-3"></i>
                    <span class="font-mono text-orange-600 font-semibold">${item.reservasi?.noResi || item.reservasi?.no_resi || '-'}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <div class="flex items-center">
                    <i class="fas fa-user text-blue-500 mr-3"></i>
                    <span class="font-semibold">${item.data_pelanggan?.nama || item.reservasi?.nama || '-'}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                <div class="flex items-center">
                    <i class="fas fa-calendar text-gray-400 mr-2"></i>
                    ${formatDate(item.created_at)}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                ${getStatusBadge(item.status)}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                <div class="flex items-center">
                    <i class="fas fa-calendar text-gray-400 mr-2"></i>
                    ${formatDate(item.tanggal_diproses)}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <div class="flex items-center justify-center space-x-1">
                    <a href="/admin/klaim-garansi/${item.id}" 
                       class="inline-flex items-center px-2.5 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-md hover:bg-blue-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <i class="fas fa-eye text-xs mr-1"></i> Detail
                    </a>
                    ${actionButtons}
                </div>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function renderMobileCards(data, startIndex) {
    const mobileCards = document.getElementById('mobileCards');
    mobileCards.innerHTML = '';
    
    data.forEach((item, index) => {
        const card = document.createElement('div');
        card.className = 'bg-white rounded-lg shadow-md border border-gray-200 p-5 card-hover transition duration-300';
        
        const actionButtons = item.status === 'diajukan' ? `
            <button type="button" 
                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-500 text-white text-sm font-medium rounded-md transition duration-300 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300"
                    onclick="showApprovalAlert(${item.id}, '${item.reservasi?.noResi || item.reservasi?.no_resi || '-'}', '${item.data_pelanggan?.nama || item.reservasi?.nama || 'Pelanggan'}')">
                <i class="fas fa-check text-xs mr-1"></i> Setuju
            </button>
            
            <button type="button" 
                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-md transition duration-300 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300"
                    onclick="showRejectionAlert(${item.id}, '${item.reservasi?.noResi || item.reservasi?.no_resi || '-'}', '${item.data_pelanggan?.nama || item.reservasi?.nama || 'Pelanggan'}')">
                <i class="fas fa-times text-xs mr-1"></i> Tolak
            </button>
        ` : '';
        
        card.innerHTML = `
            <div class="flex justify-between items-start mb-3">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-user text-orange-500 mr-2"></i>
                    ${item.data_pelanggan?.nama || item.reservasi?.nama || 'Pelanggan'}
                </h3>
                <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2 py-1 rounded-full">
                    #${startIndex + index + 1}
                </span>
            </div>
            
            <div class="space-y-3 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-receipt text-orange-500 mr-2"></i>
                    <span class="text-sm text-gray-600">No. Resi:</span>
                    <span class="ml-2 font-mono text-orange-600 font-semibold">${item.reservasi?.noResi || item.reservasi?.no_resi || '-'}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar text-gray-400 mr-2"></i>
                    <span class="text-sm text-gray-600">Tanggal Ajuan:</span>
                    <span class="ml-2 text-sm text-gray-900">${formatDate(item.created_at)}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-check text-gray-400 mr-2"></i>
                    <span class="text-sm text-gray-600">Tanggal Diproses:</span>
                    <span class="ml-2 text-sm text-gray-900">${formatDate(item.tanggal_diproses)}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-gray-400 mr-2"></i>
                    <span class="text-sm text-gray-600">Status:</span>
                    <span class="ml-2">${getStatusBadge(item.status)}</span>
                </div>
            </div>

            <div class="flex space-x-2 mt-4">
                <a href="/admin/klaim-garansi/${item.id}" 
                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-500 text-white text-sm font-medium rounded-md transition duration-300 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <i class="fas fa-eye text-xs mr-1"></i> Detail
                </a>
                ${actionButtons}
            </div>
        `;
        mobileCards.appendChild(card);
    });
}

function renderPagination(totalPages) {
    if (totalPages <= 1) {
        hidePagination();
        return;
    }
    
    const paginationContainer = document.getElementById('paginationContainer');
    const paginationNav = document.getElementById('paginationNav');
    
    paginationContainer.classList.remove('hidden');
    paginationNav.innerHTML = '';
    
    // Update footer info
    const totalItems = filteredData.length;
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
    
    document.getElementById('startEntry').textContent = startIndex + 1;
    document.getElementById('endEntry').textContent = endIndex;
    document.getElementById('totalEntriesFooter').textContent = totalItems;
    
    // Previous button
    const prevButton = createPaginationButton('❮', currentPage > 1, () => {
        if (currentPage > 1) {
            currentPage--;
            renderData();
        }
    });
    paginationNav.appendChild(prevButton);
    
    // Page numbers logic (same as ulasan)
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
    
    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }
    
    // First page and dots
    if (startPage > 1) {
        const firstPageButton = createPaginationButton('1', true, () => {
            currentPage = 1;
            renderData();
        });
        paginationNav.appendChild(firstPageButton);
        
        if (startPage > 2) {
            const dotsSpan = document.createElement('span');
            dotsSpan.textContent = '...';
            dotsSpan.className = 'px-3 py-2 text-gray-500';
            paginationNav.appendChild(dotsSpan);
        }
    }
    
    // Page numbers
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = createPaginationButton(i.toString(), true, () => {
            currentPage = i;
            renderData();
        }, i === currentPage);
        paginationNav.appendChild(pageButton);
    }
    
    // Last page and dots
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            const dotsSpan = document.createElement('span');
            dotsSpan.textContent = '...';
            dotsSpan.className = 'px-3 py-2 text-gray-500';
            paginationNav.appendChild(dotsSpan);
        }
        
        const lastPageButton = createPaginationButton(totalPages.toString(), true, () => {
            currentPage = totalPages;
            renderData();
        });
        paginationNav.appendChild(lastPageButton);
    }
    
    // Next button
    const nextButton = createPaginationButton('❯', currentPage < totalPages, () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderData();
        }
    });
    paginationNav.appendChild(nextButton);
}

function createPaginationButton(text, enabled, onClick, isActive = false) {
    const button = document.createElement('button');
    button.textContent = text;
    button.onclick = enabled ? onClick : null;
    
    let className = 'px-3 py-2 text-sm font-medium rounded-lg transition duration-150 ';
    
    if (isActive) {
        className += 'bg-orange-600 text-white shadow-md transform scale-105';
    } else if (enabled) {
        className += 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 hover:border-orange-300 hover:text-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500';
    } else {
        className += 'bg-gray-100 text-gray-400 cursor-not-allowed border border-gray-200';
    }
    
    button.className = className;
    return button;
}

function showNoDataMessage() {
    document.getElementById('tableBody').innerHTML = `
        <tr>
            <td colspan="7" class="px-6 py-8 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-file-alt text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data ditemukan</h3>
                <p class="text-gray-500">Tidak ada klaim garansi yang sesuai dengan pencarian Anda.</p>
            </td>
        </tr>
    `;
    
    document.getElementById('mobileCards').innerHTML = `
        <div class="col-span-full bg-white p-8 rounded-lg shadow-md text-center text-gray-600">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-file-alt text-4xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data ditemukan</h3>
            <p class="text-gray-500">Tidak ada klaim garansi yang sesuai dengan pencarian Anda.</p>
        </div>
    `;
}

function hideNoDataMessage() {
    // This function is called when we have data to show
    // The actual hiding is handled by renderTable and renderMobileCards
}

function hidePagination() {
    document.getElementById('paginationContainer').classList.add('hidden');
}

// SweetAlert2 Functions
function showApprovalAlert(klaimId, noResi, namaPelanggan) {
    Swal.fire({
        title: 'Setujui Klaim Garansi?',
        html: `
            <div class="text-left">
                <p class="mb-2"><strong>No. Resi:</strong> ${noResi}</p>
                <p class="mb-3"><strong>Pelanggan:</strong> ${namaPelanggan}</p>
                <p class="text-gray-600">Anda yakin ingin menyetujui klaim garansi ini?</p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-check mr-2"></i>Ya, Setujui',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-lg shadow-2xl',
            title: 'text-lg font-semibold text-gray-800',
            confirmButton: 'bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg px-6 py-3 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105',
            cancelButton: 'bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg px-6 py-3 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 mr-3'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang memproses persetujuan klaim garansi',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-lg shadow-2xl'
                },
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/klaim-garansi/${klaimId}/approve`;
            
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function showRejectionAlert(klaimId, noResi, namaPelanggan) {
    Swal.fire({
        title: 'Tolak Klaim Garansi?',
        html: `
            <div class="text-left">
                <p class="mb-2"><strong>No. Resi:</strong> ${noResi}</p>
                <p class="mb-3"><strong>Pelanggan:</strong> ${namaPelanggan}</p>
                <p class="text-gray-600">Anda yakin ingin menolak klaim garansi ini?</p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-times mr-2"></i>Ya, Tolak',
        cancelButtonText: '<i class="fas fa-arrow-left mr-2"></i>Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-lg shadow-2xl',
            title: 'text-lg font-semibold text-gray-800',
            confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg px-6 py-3 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105',
            cancelButton: 'bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg px-6 py-3 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 mr-3'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang memproses penolakan klaim garansi',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-lg shadow-2xl'
                },
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/klaim-garansi/${klaimId}/reject`;
            
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            form.appendChild(tokenInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush 