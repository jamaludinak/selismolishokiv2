@extends('layouts.admin')

@section('title', 'Jenis Kerusakan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-extrabold text-gray-900">Daftar Jenis Kerusakan</h2>
        <button onclick="openCreateModal()" 
                class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow-lg hover:bg-orange-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Jenis Kerusakan
        </button>
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

    <!-- Desktop Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Jenis Kerusakan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estimasi Biaya</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($jenisKerusakan as $kerusakan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ ($jenisKerusakan->currentPage() - 1) * $jenisKerusakan->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kerusakan->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $kerusakan->biaya_estimasi ? 'Rp ' . number_format($kerusakan->biaya_estimasi, 0, ',', '.') : 'Belum ditentukan' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="openEditModal({{ $kerusakan->id }}, '{{ $kerusakan->nama }}', {{ $kerusakan->biaya_estimasi ?? 'null' }})" 
                                        class="text-yellow-600 hover:text-yellow-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                                <button type="button" onclick="confirmDeleteJenisKerusakan({{ $kerusakan->id }})" 
                                        class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                                <form id="delete-jenis-kerusakan-form-{{ $kerusakan->id }}" action="{{ route('jenis_kerusakan.destroy', $kerusakan->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-lg text-gray-500">
                            <i class="fas fa-box-open text-4xl mb-3 text-gray-300"></i>
                            <p>Tidak ada jenis kerusakan yang ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Cards -->
    <div class="grid grid-cols-1 gap-6 md:hidden">
        @forelse ($jenisKerusakan as $kerusakan)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $kerusakan->nama }}</h3>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">ID:</strong> {{ $kerusakan->id }}</p>
                <p class="text-gray-600 mb-3"><strong class="text-gray-800">Estimasi Biaya:</strong>
                    {{ $kerusakan->biaya_estimasi ? 'Rp ' . number_format($kerusakan->biaya_estimasi, 0, ',', '.') : 'Belum ditentukan' }}
                </p>
                <div class="flex space-x-3 mt-4">
                    <button onclick="openEditModal({{ $kerusakan->id }}, '{{ $kerusakan->nama }}', {{ $kerusakan->biaya_estimasi ?? 'null' }})" 
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-md transition duration-300 hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </button>
                    <button type="button" onclick="confirmDeleteJenisKerusakan({{ $kerusakan->id }})" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-box-open text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Tidak ada jenis kerusakan yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jenisKerusakan->hasPages())
        <div class="mt-6">
            {{ $jenisKerusakan->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-orange-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Tambah Jenis Kerusakan</h3>
            </div>
            <form action="{{ route('jenis_kerusakan.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Jenis Kerusakan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="Masukkan nama jenis kerusakan">
                    </div>
                    
                    <div>
                        <label for="biaya_estimasi" class="block text-sm font-medium text-gray-700 mb-1">
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
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition duration-200">
                        Simpan
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
            <div class="bg-yellow-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Edit Jenis Kerusakan</h3>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Jenis Kerusakan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               placeholder="Masukkan nama jenis kerusakan">
                    </div>
                    
                    <div>
                        <label for="edit_biaya_estimasi" class="block text-sm font-medium text-gray-700 mb-1">
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
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition duration-200">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function openEditModal(id, nama, biayaEstimasi) {
    document.getElementById('editForm').action = `/admin/jenis_kerusakan/${id}`;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_biaya_estimasi').value = biayaEstimasi || '';
    document.getElementById('editModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
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
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-jenis-kerusakan-form-' + id).submit();
        }
    });
}

// Close modals when clicking outside
document.getElementById('createModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateModal();
    }
});

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
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

// Handle edit form submission
document.getElementById('editForm').addEventListener('submit', function(e) {
    // Let the form submit normally with Laravel's method spoofing
    // The @method('PUT') directive in the form will handle the method override
    return true;
});
</script>
@endpush