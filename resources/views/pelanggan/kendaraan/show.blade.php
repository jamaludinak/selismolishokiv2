@extends('pelanggan.layouts.app')

@section('title', 'Detail Kendaraan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-motorcycle mr-3 text-4xl"></i>
                            Detail Kendaraan
                        </h1>
                        <p class="text-orange-100 mt-2">Informasi lengkap kendaraan Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('kendaraan.index') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Kendaraan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Information Card -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Vehicle Basic Info -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                Informasi Kendaraan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-tag text-green-500 mr-2"></i>Merk Kendaraan
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-green-500">
                                            <p class="text-lg font-semibold text-gray-900">{{ $kendaraan->merk }}</p>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-cogs text-blue-500 mr-2"></i>Tipe Kendaraan
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-blue-500">
                                            <p class="text-lg font-semibold text-gray-900">{{ $kendaraan->tipe ?: 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-list text-purple-500 mr-2"></i>Jenis Kendaraan
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-purple-500">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                @if($kendaraan->jenis_kendaraan == 'sepeda_listrik') bg-blue-100 text-blue-800
                                                @else bg-purple-100 text-purple-800 @endif">
                                                <i class="fas fa-motorcycle mr-2"></i>
                                                {{ ucfirst(str_replace('_', ' ', $kendaraan->jenis_kendaraan)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-barcode text-indigo-500 mr-2"></i>Nomor Rangka
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-indigo-500">
                                            <p class="text-lg font-mono font-semibold text-gray-900">{{ $kendaraan->nomor_rangka ?: 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">
                                            <i class="fas fa-calendar text-orange-500 mr-2"></i>Tahun Pembelian
                                        </label>
                                        <div class="bg-gray-50 rounded-lg px-4 py-3 border-l-4 border-orange-500">
                                            <p class="text-lg font-semibold text-gray-900">{{ $kendaraan->tahun_pembelian ?: 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Photo -->
                    @if($kendaraan->foto)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-camera mr-2 text-purple-500"></i>
                                Foto Kendaraan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="relative group cursor-pointer" onclick="openImageModal('{{ asset($kendaraan->foto) }}')">
                                <img src="{{ asset($kendaraan->foto) }}" 
                                     alt="Foto Kendaraan {{ $kendaraan->merk }}" 
                                     class="w-full h-64 object-cover rounded-lg shadow-md group-hover:shadow-xl transition-all duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2 text-center">Klik untuk memperbesar foto</p>
                        </div>
                    </div>
                    @endif

                    <!-- Related Reservations -->
                    @if(isset($reservasi) && $reservasi->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-calendar-check mr-2 text-indigo-500"></i>
                                Riwayat Reservasi
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4" id="reservasiContainer">
                                @php
                                    $sortedReservasi = $reservasi->sortByDesc('tanggal');
                                @endphp
                                @foreach($sortedReservasi as $index => $item)
                                <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-500 hover:shadow-md transition-shadow duration-200 reservasi-item" 
                                     data-index="{{ $index }}" style="{{ $index >= 10 ? 'display: none;' : '' }}">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="space-y-1">
                                            <p class="font-semibold text-gray-900">{{ $item->noResi }}</p>
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-calendar text-indigo-500 mr-1"></i>
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-wrench text-indigo-500 mr-1"></i>
                                                {{ $item->nama_jenis_kerusakan }}
                                            </p>
                                        </div>
                                        <div class="mt-2 sm:mt-0">
                                            <a href="{{ route('riwayats.index') }}" 
                                               class="inline-flex items-center px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                                                <i class="fas fa-history mr-1"></i>
                                                Lihat Riwayat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            @if($sortedReservasi->count() > 10)
                            <!-- Pagination Controls -->
                            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                                <div class="text-sm text-gray-700">
                                    Menampilkan <span id="showingStart">1</span> - <span id="showingEnd">10</span> dari <span id="totalItems">{{ $sortedReservasi->count() }}</span> reservasi
                                </div>
                                <div class="flex space-x-1" id="paginationControls">
                                    <!-- Pagination buttons will be generated by JavaScript -->
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Warranty Status Card -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-shield-alt mr-2 text-yellow-500"></i>
                                Status Garansi
                            </h3>
                        </div>
                        <div class="p-6">
                            @if($kendaraan->tanggal_berakhir_garansi)
                                @php
                                    $tanggalGaransi = \Carbon\Carbon::parse($kendaraan->tanggal_berakhir_garansi);
                                    $isAktif = $tanggalGaransi->isFuture();
                                    $sisaHari = $isAktif ? $tanggalGaransi->diffInDays(now()) : 0;
                                @endphp
                                
                                <div class="text-center mb-4">
                                    <div class="mx-auto w-20 h-20 rounded-full flex items-center justify-center mb-3
                                        @if($isAktif) bg-green-100 @else bg-red-100 @endif">
                                        <i class="@if($isAktif) fas fa-check-circle text-green-500 @else fas fa-times-circle text-red-500 @endif text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold 
                                        @if($isAktif) text-green-700 @else text-red-700 @endif">
                                        @if($isAktif) Garansi Aktif @else Garansi Berakhir @endif
                                    </h4>
                                </div>

                                <div class="space-y-3">
                                    <div class="bg-gray-50 rounded-lg px-4 py-3">
                                        <label class="text-sm font-medium text-gray-600 block mb-1">Tanggal Berakhir</label>
                                        <p class="font-semibold text-gray-900">{{ $tanggalGaransi->format('d F Y') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fas fa-question-circle text-gray-400 text-3xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Garansi</h4>
                                    <p class="text-gray-500 text-sm">Informasi garansi belum tersedia untuk kendaraan ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Cards -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-white border-b border-gray-200 px-6 py-4">
                            <h3 class="text-xl font-semibold text-black flex items-center">
                                <i class="fas fa-tools mr-2 text-indigo-500"></i>
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('kendaraan.edit', $kendaraan->id) }}" 
                               class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                                Edit Kendaraan
                            </a>

                            <a href="{{ route('reservasi.create', ['kendaraan_id' => $kendaraan->id]) }}" 
                               class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                <i class="fas fa-calendar-plus mr-2 group-hover:scale-110 transition-transform"></i>
                                Buat Reservasi
                            </a>

                            @if($kendaraan->tanggal_berakhir_garansi && \Carbon\Carbon::parse($kendaraan->tanggal_berakhir_garansi)->isFuture())
                                @if(isset($reservasiAktifGaransi) && $reservasiAktifGaransi)
                                    <a href="{{ route('klaim-garansi.create', $reservasiAktifGaransi->noResi) }}" 
                                       class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                        <i class="fas fa-shield-alt mr-2 group-hover:scale-110 transition-transform"></i>
                                        Klaim Garansi ({{ $reservasiAktifGaransi->noResi }})
                                    </a>
                                @else
                                    <div class="w-full bg-gray-400 text-white px-4 py-3 rounded-lg font-medium text-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <div class="text-sm">
                                            <div>Klaim Garansi Tidak Tersedia</div>
                                            <div class="text-xs opacity-80 mt-1">Tidak ada reservasi dengan garansi aktif</div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST" class="delete-form" data-entity="kendaraan">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center group">
                                    <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                                    Hapus Kendaraan
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50" onclick="closeImageModal()">
        <div class="max-w-4xl max-h-full p-4">
            <img id="modalImage" src="" alt="Enlarged view" class="max-w-full max-h-full object-contain rounded-lg">
        </div>
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endsection
@push('js')
    <!-- Scripts -->
    <script>
        // Image modal functions
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForm = document.querySelector('.delete-form');
            
            if (deleteForm) {
                deleteForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    if (confirm('Apakah Anda yakin ingin menghapus kendaraan ini? Tindakan ini tidak dapat dibatalkan.')) {
                        this.submit();
                    }
                });
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Pagination for reservations
        class ReservasiPagination {
            constructor() {
                this.itemsPerPage = 10;
                this.currentPage = 1;
                this.allItems = [];
                this.init();
            }

            init() {
                this.allItems = Array.from(document.querySelectorAll('.reservasi-item'));
                if (this.allItems.length > this.itemsPerPage) {
                    this.setupPagination();
                    this.showPage(1);
                }
            }

            setupPagination() {
                const totalPages = Math.ceil(this.allItems.length / this.itemsPerPage);
                const paginationContainer = document.getElementById('paginationControls');
                
                if (!paginationContainer) return;

                paginationContainer.innerHTML = '';

                // Previous button
                const prevBtn = this.createButton('‹', this.currentPage - 1, this.currentPage === 1);
                paginationContainer.appendChild(prevBtn);

                // Page numbers
                const startPage = Math.max(1, this.currentPage - 2);
                const endPage = Math.min(totalPages, this.currentPage + 2);

                if (startPage > 1) {
                    paginationContainer.appendChild(this.createButton(1, 1));
                    if (startPage > 2) {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.className = 'px-2 py-1 text-gray-500';
                        paginationContainer.appendChild(ellipsis);
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    const btn = this.createButton(i, i, false, i === this.currentPage);
                    paginationContainer.appendChild(btn);
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.className = 'px-2 py-1 text-gray-500';
                        paginationContainer.appendChild(ellipsis);
                    }
                    paginationContainer.appendChild(this.createButton(totalPages, totalPages));
                }

                // Next button
                const nextBtn = this.createButton('›', this.currentPage + 1, this.currentPage === totalPages);
                paginationContainer.appendChild(nextBtn);
            }

            createButton(text, page, disabled = false, active = false) {
                const button = document.createElement('button');
                button.textContent = text;
                button.className = `px-3 py-1 rounded text-sm transition-colors duration-200 ${
                    disabled 
                        ? 'bg-gray-200 text-gray-400 cursor-not-allowed' 
                        : active 
                            ? 'bg-indigo-500 text-white' 
                            : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50'
                }`;
                
                if (!disabled) {
                    button.addEventListener('click', () => this.showPage(page));
                } else {
                    button.disabled = true;
                }

                return button;
            }

            showPage(page) {
                this.currentPage = page;
                const startIndex = (page - 1) * this.itemsPerPage;
                const endIndex = startIndex + this.itemsPerPage;

                // Hide all items
                this.allItems.forEach(item => {
                    item.style.display = 'none';
                });

                // Show items for current page
                this.allItems.slice(startIndex, endIndex).forEach(item => {
                    item.style.display = 'block';
                });

                // Update pagination UI
                this.setupPagination();
                this.updateItemsInfo();
            }

            updateItemsInfo() {
                const startIndex = (this.currentPage - 1) * this.itemsPerPage + 1;
                const endIndex = Math.min(this.currentPage * this.itemsPerPage, this.allItems.length);

                document.getElementById('showingStart').textContent = startIndex;
                document.getElementById('showingEnd').textContent = endIndex;
                document.getElementById('totalItems').textContent = this.allItems.length;
            }
        }

        // Initialize pagination when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new ReservasiPagination();
        });
    </script>
@endpush