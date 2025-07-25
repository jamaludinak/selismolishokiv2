@extends('layouts.admin')

@section('title', 'Teknisi - Kelola Reservasi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kelola Reservasi - Teknisi</h1>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="mb-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            <span class="text-blue-700">Menampilkan reservasi yang siap diproses. Status "Confirmed" dapat diproses atau langsung diselesaikan. Status "Process" hanya dapat diselesaikan.</span>
        </div>
    </div>
</div>

<!-- Reservasi Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($reservasis as $reservasi)
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="bg-orange-600 text-white px-4 py-3">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-lg">{{ $reservasi->noResi }}</h3>
                    <span class="px-2 py-1 rounded text-xs 
                        @if($reservasi->status == 'confirmed') bg-blue-100 text-blue-800
                        @elseif($reservasi->status == 'process') bg-indigo-100 text-indigo-800
                        @endif">
                        {{ ucfirst($reservasi->status) }}
                    </span>
                </div>
            </div>
            
            <!-- Content -->
            <div class="p-4">
                <!-- Customer Info -->
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Informasi Pelanggan</h4>
                    <div class="space-y-1 text-sm">
                        <p><span class="font-medium">Nama:</span> {{ $reservasi->namaLengkap }}</p>
                        <p><span class="font-medium">Telepon:</span> {{ $reservasi->noTelp }}</p>
                        <p><span class="font-medium">Alamat:</span> {{ Str::limit($reservasi->alamatLengkap, 50) }}</p>
                    </div>
                </div>

                <!-- Service Info -->
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Informasi Servis</h4>
                    <div class="space-y-1 text-sm">
                        <p><span class="font-medium">Jenis Servis:</span> {{ $reservasi->servis }}</p>
                        <p><span class="font-medium">Kerusakan:</span> {{ $reservasi->jenisKerusakan->nama ?? '-' }}</p>
                        @if($reservasi->kendaraan)
                            <p><span class="font-medium">Kendaraan:</span> {{ $reservasi->kendaraan->kode ?? '-' }}</p>
                        @endif
                        @if($reservasi->teknisi)
                            <p><span class="font-medium">Teknisi:</span> <span class="text-green-600 font-semibold">{{ $reservasi->teknisi->name }}</span></p>
                        @endif
                    </div>
                </div>

                <!-- Schedule Info -->
                @if($reservasi->jadwals->isNotEmpty())
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Jadwal</h4>
                    @foreach($reservasi->jadwals as $jadwal)
                        <div class="bg-gray-50 rounded p-2 mb-2">
                            <p class="text-sm"><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</p>
                            <p class="text-sm"><span class="font-medium">Waktu:</span> {{ \Carbon\Carbon::parse($jadwal->waktuMulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktuSelesai)->format('H:i') }}</p>
                        </div>
                    @endforeach
                </div>
                @endif

                <!-- Description -->
                @if($reservasi->deskripsi)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Deskripsi</h4>
                    <p class="text-sm text-gray-600">{{ Str::limit($reservasi->deskripsi, 100) }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="mb-3">
                    @if($reservasi->status == 'confirmed')
                        <div class="bg-blue-50 border border-blue-200 rounded p-2 mb-3">
                            <p class="text-xs text-blue-700 font-medium">
                                <i class="fas fa-info-circle mr-1"></i>
                                Reservasi siap diproses. Pilih "Proses" untuk mulai bekerja atau "Complete" untuk langsung selesaikan.
                            </p>
                        </div>
                    @elseif($reservasi->status == 'process')
                        <div class="bg-indigo-50 border border-indigo-200 rounded p-2 mb-3">
                            <p class="text-xs text-indigo-700 font-medium">
                                <i class="fas fa-tools mr-1"></i>
                                Reservasi sedang dalam proses. Selesaikan pekerjaan dan klik "Complete".
                            </p>
                        </div>
                    @endif
                </div>
                
                <div class="flex space-x-2">
                    @if($reservasi->status == 'confirmed')
                        <!-- For confirmed status: show both Process and Complete buttons -->
                        <button onclick="openProcessModal({{ $reservasi->id }})" 
                                class="flex-1 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-cogs mr-1"></i> Proses
                        </button>
                        <button onclick="openCompleteModal({{ $reservasi->id }})" 
                                class="flex-1 bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 transition duration-200">
                            <i class="fas fa-check mr-1"></i> Complete
                        </button>
                    @elseif($reservasi->status == 'process')
                        <!-- For process status: show only Complete button -->
                        <button onclick="openCompleteModal({{ $reservasi->id }})" 
                                class="w-full bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 transition duration-200">
                            <i class="fas fa-check mr-1"></i> Complete
                        </button>
                    @endif
                    
                    <!-- Detail button for all statuses -->
                    <button onclick="openDetailModal({{ $reservasi->id }})" 
                            class="w-full bg-purple-600 text-white px-3 py-2 rounded text-sm hover:bg-purple-700 transition duration-200 mt-2">
                        <i class="fas fa-eye mr-1"></i> Lihat Detail
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-clipboard-list text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak Ada Reservasi</h3>
                <p class="text-gray-500">Belum ada reservasi dengan status "Confirmed" atau "Process" yang perlu diproses.</p>
            </div>
        </div>
    @endforelse
</div>

<!-- Process Modal -->
<div id="processModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Proses Reservasi</h3>
            </div>
            <form id="processForm" class="p-6">
                @csrf
                <input type="hidden" name="status" value="process">
                <input type="hidden" name="reservasi_id" id="processReservasiId">
                
                <div class="mb-4">
                    <p class="text-gray-600">Apakah Anda yakin ingin memproses reservasi ini?</p>
                    <p class="text-sm text-gray-500 mt-2">Status akan berubah menjadi "Process"</p>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" onclick="closeProcessModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                        Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Complete Modal -->
<div id="completeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-green-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Complete Reservasi</h3>
            </div>
            <form id="completeForm" class="p-6">
                @csrf
                <input type="hidden" name="status" value="completed">
                <input type="hidden" name="reservasi_id" id="completeReservasiId">
                
                <div class="space-y-4">
                    <div>
                        <label for="total_harga" class="block text-sm font-medium text-gray-700 mb-1">
                            Total Harga <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="total_harga" name="total_harga" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Masukkan total harga">
                    </div>
                    
                    <div>
                        <label for="tanggal_berakhir_garansi" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Berakhir Garansi (Opsional)
                        </label>
                        <input type="date" id="tanggal_berakhir_garansi" name="tanggal_berakhir_garansi"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan untuk menggunakan default (30 hari)</p>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeCompleteModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">
                        Complete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-purple-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Detail Reservasi</h3>
            </div>
            <div id="detailContent" class="p-6">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openProcessModal(reservasiId) {
    document.getElementById('processReservasiId').value = reservasiId;
    document.getElementById('processModal').classList.remove('hidden');
}

function closeProcessModal() {
    document.getElementById('processModal').classList.add('hidden');
}

function openCompleteModal(reservasiId) {
    document.getElementById('completeReservasiId').value = reservasiId;
    document.getElementById('completeModal').classList.remove('hidden');
}

function closeCompleteModal() {
    document.getElementById('completeModal').classList.add('hidden');
}

function openDetailModal(reservasiId) {
    document.getElementById('detailModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    // Load reservation details
    fetch(`/admin/teknisi/${reservasiId}/detail`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detailContent').innerHTML = generateDetailContent(data);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('detailContent').innerHTML = '<p class="text-red-500">Error loading data</p>';
        });
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function generateDetailContent(reservasi) {
    return `
        <div class="space-y-6">
            <!-- Reservation Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Reservasi</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p><span class="font-medium">No. Resi:</span> <span class="font-mono text-orange-600">${reservasi.noResi}</span></p>
                        <p><span class="font-medium">Nama:</span> ${reservasi.namaLengkap}</p>
                        <p><span class="font-medium">Telepon:</span> ${reservasi.noTelp}</p>
                        <p><span class="font-medium">Jenis Servis:</span> ${reservasi.servis}</p>
                        <p><span class="font-medium">Kerusakan:</span> ${reservasi.jenis_kerusakan ? reservasi.jenis_kerusakan.nama : 'N/A'}</p>
                    </div>
                    <div>
                        <p><span class="font-medium">Status:</span> 
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                ${reservasi.status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ''}
                                ${reservasi.status == 'confirmed' ? 'bg-blue-100 text-blue-800' : ''}
                                ${reservasi.status == 'process' ? 'bg-indigo-100 text-indigo-800' : ''}
                                ${reservasi.status == 'completed' ? 'bg-green-100 text-green-800' : ''}
                                ${reservasi.status == 'cancelled' ? 'bg-red-100 text-red-800' : ''}">
                                ${reservasi.status.charAt(0).toUpperCase() + reservasi.status.slice(1)}
                            </span>
                        </p>
                        ${reservasi.kendaraan ? `<p><span class="font-medium">Kendaraan:</span> ${reservasi.kendaraan.kode || 'N/A'}</p>` : ''}
                        ${reservasi.total_harga ? `<p><span class="font-medium">Total Harga:</span> Rp ${Number(reservasi.total_harga).toLocaleString()}</p>` : ''}
                        ${reservasi.tanggal_berakhir_garansi ? `<p><span class="font-medium">Garansi:</span> ${new Date(reservasi.tanggal_berakhir_garansi).toLocaleDateString('id-ID')}</p>` : ''}
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5 class="font-medium text-gray-800 mb-2">Alamat Lengkap:</h5>
                    <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded">${reservasi.alamatLengkap}</p>
                </div>
                
                <div class="mt-4">
                    <h5 class="font-medium text-gray-800 mb-2">Deskripsi Kerusakan:</h5>
                    <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded">${reservasi.deskripsi || 'Tidak ada deskripsi'}</p>
                </div>
            </div>
            
            <!-- Schedule Info -->
            ${reservasi.jadwals && reservasi.jadwals.length > 0 ? `
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 border-b pb-2">Jadwal</h4>
                    <div class="space-y-2">
                        ${reservasi.jadwals.map(jadwal => `
                            <div class="bg-gray-50 rounded p-3">
                                <p class="text-sm"><span class="font-medium">Tanggal:</span> ${new Date(jadwal.tanggal).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                <p class="text-sm"><span class="font-medium">Waktu:</span> ${new Date(jadwal.waktuMulai).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })} - ${new Date(jadwal.waktuSelesai).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
            ` : ''}
            
            <!-- Existing Media -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-800 border-b pb-2">Media</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h5 class="font-medium text-gray-700 mb-2">Foto Kerusakan:</h5>
                        ${reservasi.gambar ? `
                            <img src="/${reservasi.gambar}" alt="Foto Kerusakan" class="w-full h-48 object-cover rounded shadow-md">
                        ` : '<p class="text-sm text-gray-500 italic">Tidak ada foto</p>'}
                    </div>
                    
                    <div>
                        <h5 class="font-medium text-gray-700 mb-2">Video Kerusakan:</h5>
                        ${reservasi.video ? `
                            <video controls class="w-full h-48 object-cover rounded shadow-md">
                                <source src="/${reservasi.video}" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        ` : '<p class="text-sm text-gray-500 italic">Tidak ada video</p>'}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button onclick="closeDetailModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                Tutup
            </button>
        </div>
    `;
}

// Process Form Submit
document.getElementById('processForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const reservasiId = document.getElementById('processReservasiId').value;
    const formData = new FormData(this);
    
    fetch(`/admin/teknisi/${reservasiId}/status`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            status: 'process'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeProcessModal();
            location.reload();
        } else {
            alert('Terjadi kesalahan: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses reservasi');
    });
});

// Complete Form Submit
document.getElementById('completeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const reservasiId = document.getElementById('completeReservasiId').value;
    const totalHarga = document.getElementById('total_harga').value;
    const tanggalGaransi = document.getElementById('tanggal_berakhir_garansi').value;
    
    if (!totalHarga) {
        alert('Total harga harus diisi!');
        return;
    }
    
    const formData = {
        status: 'completed',
        total_harga: totalHarga
    };
    
    if (tanggalGaransi) {
        formData.tanggal_berakhir_garansi = tanggalGaransi;
    }
    
    fetch(`/admin/teknisi/${reservasiId}/status`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeCompleteModal();
            location.reload();
        } else {
            alert('Terjadi kesalahan: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyelesaikan reservasi');
    });
});

// Close modals when clicking outside
document.getElementById('processModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProcessModal();
    }
});

document.getElementById('completeModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCompleteModal();
    }
});

document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});
</script>
@endpush 