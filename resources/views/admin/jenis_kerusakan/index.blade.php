@extends('layouts.admin')

@section('title', 'Jenis Kerusakan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-white mb-2">Jenis Kerusakan</h2>
                <p class="text-orange-100">Kelola jenis kerusakan kendaraan dan estimasi biayanya</p>
            </div>
            <button onclick="openCreateModal()" 
                    class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-white text-orange-600 font-semibold rounded-lg shadow-md hover:bg-gray-50 transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Jenis Kerusakan
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
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
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search mr-1 text-orange-500"></i> Cari Jenis Kerusakan
                </label>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama jenis kerusakan..." 
                           class="search-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                </div>
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
            <div id="clearSearch" class="hidden">
                <button onclick="clearSearch()" class="inline-flex items-center text-orange-600 hover:text-orange-800 font-medium transition duration-200">
                    <i class="fas fa-times mr-1"></i> Hapus Pencarian
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
                            <i class="fas fa-tools mr-2"></i>
                            Nama Jenis Kerusakan
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-white uppercase tracking-wider">
                        <div class="flex items-center">
                            <i class="fas fa-money-bill-wave mr-2"></i>
                            Estimasi Biaya
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
            <i class="fas fa-search text-6xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada data ditemukan</h3>
        <p class="text-gray-500" id="noDataText">Tidak ada jenis kerusakan yang sesuai dengan pencarian Anda.</p>
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
<script type="application/json" id="jenisKerusakanData">
    @json($jenisKerusakan->map(function($item) {
        return [
            'id' => $item->id,
            'nama' => $item->nama,
            'biaya_estimasi' => $item->biaya_estimasi
        ];
    })->values())
</script>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Tambah Jenis Kerusakan
                </h3>
            </div>
            <form action="{{ route('jenis_kerusakan.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tools mr-1 text-orange-500"></i>
                            Nama Jenis Kerusakan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="Masukkan nama jenis kerusakan">
                    </div>
                    
                    <div>
                        <label for="biaya_estimasi" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-money-bill-wave mr-1 text-green-500"></i>
                            Estimasi Biaya (Opsional)
                        </label>
                        <input type="number" id="biaya_estimasi" name="biaya_estimasi"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="Masukkan estimasi biaya">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika belum ditentukan</p>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeCreateModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition duration-200">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Jenis Kerusakan
                </h3>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tools mr-1 text-orange-500"></i>
                            Nama Jenis Kerusakan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               placeholder="Masukkan nama jenis kerusakan">
                    </div>
                    
                    <div>
                        <label for="edit_biaya_estimasi" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-money-bill-wave mr-1 text-green-500"></i>
                            Estimasi Biaya (Opsional)
                        </label>
                        <input type="number" id="edit_biaya_estimasi" name="biaya_estimasi"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               placeholder="Masukkan estimasi biaya">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika belum ditentukan</p>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeEditModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition duration-200">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Global variables
let jenisKerusakanData = [];
let filteredData = [];
let currentPage = 1;
let itemsPerPage = 10;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Load data from JSON script tag
    const dataScript = document.getElementById('jenisKerusakanData');
    if (dataScript) {
        jenisKerusakanData = JSON.parse(dataScript.textContent);
        filteredData = [...jenisKerusakanData];
        renderData();
        setupEventListeners();
    }
});

function setupEventListeners() {
    // Search input
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', debounce(handleSearch, 300));
    
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
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    if (searchTerm === '') {
        filteredData = [...jenisKerusakanData];
        document.getElementById('clearSearch').classList.add('hidden');
        document.getElementById('filteredText').classList.add('hidden');
    } else {
        filteredData = jenisKerusakanData.filter(item => 
            item.nama.toLowerCase().includes(searchTerm)
        );
        document.getElementById('clearSearch').classList.remove('hidden');
        document.getElementById('filteredText').classList.remove('hidden');
        document.getElementById('totalEntries').textContent = jenisKerusakanData.length;
    }
    
    currentPage = 1;
    renderData();
}

function clearSearch() {
    document.getElementById('searchInput').value = '';
    filteredData = [...jenisKerusakanData];
    document.getElementById('clearSearch').classList.add('hidden');
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

function renderTable(data, startIndex) {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';
    
    data.forEach((item, index) => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50 transition duration-150';
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-100 text-orange-800 text-xs font-bold rounded-full">
                    ${startIndex + index + 1}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                <div class="flex items-center">
                    <i class="fas fa-tools text-orange-500 mr-3"></i>
                    <span class="font-semibold">${item.nama}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                <div class="flex items-center">
                    <i class="fas fa-money-bill-wave text-green-500 mr-3"></i>
                    <span class="font-medium">${item.biaya_estimasi ? 'Rp ' + new Intl.NumberFormat('id-ID').format(item.biaya_estimasi) : 'Belum ditentukan'}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <div class="flex items-center justify-center space-x-3">
                    <button onclick="openEditModal(${item.id}, '${item.nama.replace(/'/g, "\\'")}', ${item.biaya_estimasi || 'null'})" 
                            class="inline-flex items-center px-3 py-2 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-lg hover:bg-yellow-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button type="button" onclick="confirmDeleteJenisKerusakan(${item.id})" 
                            class="inline-flex items-center px-3 py-2 bg-red-100 text-red-800 text-xs font-medium rounded-lg hover:bg-red-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-red-300">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                    </button>
                    <form id="delete-jenis-kerusakan-form-${item.id}" action="/admin/jenis_kerusakan/${item.id}" method="POST" class="hidden">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
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
        card.innerHTML = `
            <div class="flex justify-between items-start mb-3">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-tools text-orange-500 mr-2"></i>
                    ${item.nama}
                </h3>
                <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2 py-1 rounded-full">
                    #${startIndex + index + 1}
                </span>
            </div>
            <div class="space-y-2 mb-4">
                <p class="text-gray-600 flex items-center">
                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                    <strong class="text-gray-800">Estimasi Biaya:</strong>
                    <span class="ml-1">${item.biaya_estimasi ? 'Rp ' + new Intl.NumberFormat('id-ID').format(item.biaya_estimasi) : 'Belum ditentukan'}</span>
                </p>
            </div>
            <div class="flex space-x-3">
                <button onclick="openEditModal(${item.id}, '${item.nama.replace(/'/g, "\\'")}', ${item.biaya_estimasi || 'null'})" 
                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md transition duration-300 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    <i class="fas fa-edit mr-2"></i> Edit
                </button>
                <button type="button" onclick="confirmDeleteJenisKerusakan(${item.id})" 
                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
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
    
    // Page numbers
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
    
    // Add hover effect for active button
    if (isActive) {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 8px rgba(249, 115, 22, 0.3)';
        });
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
        });
    }
    
    return button;
}

function showNoDataMessage() {
    document.getElementById('tableBody').innerHTML = `
        <tr>
            <td colspan="4" class="px-6 py-8 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-search text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data ditemukan</h3>
                <p class="text-gray-500">Tidak ada jenis kerusakan yang sesuai dengan pencarian Anda.</p>
            </td>
        </tr>
    `;
    
    document.getElementById('mobileCards').innerHTML = `
        <div class="col-span-full bg-white p-8 rounded-lg shadow-md text-center text-gray-600">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-search text-4xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data ditemukan</h3>
            <p class="text-gray-500">Tidak ada jenis kerusakan yang sesuai dengan pencarian Anda.</p>
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

// Modal functions
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    document.getElementById('nama').focus();
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    // Reset form
    document.querySelector('#createModal form').reset();
}

function openEditModal(id, nama, biayaEstimasi) {
    document.getElementById('editForm').action = `/admin/jenis_kerusakan/${id}`;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_biaya_estimasi').value = biayaEstimasi || '';
    document.getElementById('editModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    document.getElementById('edit_nama').focus();
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function confirmDeleteJenisKerusakan(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data jenis kerusakan ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: 'px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700',
            cancelButton: 'px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-jenis-kerusakan-form-' + id).submit();
        }
    });
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.id === 'createModal') {
        closeCreateModal();
    }
    if (e.target.id === 'editModal') {
        closeEditModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeCreateModal();
        closeEditModal();
    }
});
</script>
@endpush