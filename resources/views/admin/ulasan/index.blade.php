@extends('layouts.admin')

@section('title', 'Daftar Ulasan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Daftar Ulasan Pelanggan</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex justify-start mb-6">
        <button onclick="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow-lg hover:bg-orange-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Ulasan
        </button>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end" method="GET" action="{{ route('ulasan.index') }}">
            <div>
                <label for="search_nama" class="block text-sm font-medium text-gray-700">Cari Nama</label>
                <input
                    type="text"
                    name="search_nama"
                    id="search_nama"
                    placeholder="Cari berdasarkan nama"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('search_nama') }}">
            </div>
            <div>
                <label for="filter_rating" class="block text-sm font-medium text-gray-700">Filter Rating</label>
                <select
                    name="filter_rating"
                    id="filter_rating"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    <option value="">Semua Rating</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('filter_rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </div>
            <div class="col-span-1 md:col-span-1 flex justify-end">
                <button
                    type="submit"
                    class="w-full md:w-auto bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ulasan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Rating</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($ulasans as $ulasan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ulasan->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ulasan->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 max-w-lg truncate">{{ $ulasan->ulasan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-md {{ $i <= $ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                                <span class="ml-2 font-semibold">{{ $ulasan->rating }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="openEditModal({{ $ulasan->id }})" class="text-yellow-600 hover:text-yellow-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                                <button type="button" onclick="confirmDeleteUlasan({{ $ulasan->id }})" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-lg text-gray-500">
                            <i class="fas fa-comments-slash text-4xl mb-3 text-gray-300"></i>
                            <p>Tidak ada ulasan yang ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-6 md:hidden">
        @forelse ($ulasans as $ulasan)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $ulasan->nama }}</h3>
                <p class="text-gray-600 mb-3">{{ $ulasan->ulasan }}</p>
                <div class="flex items-center mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star text-lg {{ $i <= $ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    @endfor
                    <span class="ml-2 text-lg font-semibold text-gray-800">{{ $ulasan->rating }}</span>
                </div>

                <div class="flex space-x-3 mt-4">
                    <button onclick="openEditModal({{ $ulasan->id }})" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-md transition duration-300 hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </button>
                    <button type="button" onclick="confirmDeleteUlasan({{ $ulasan->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-comments-slash text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Tidak ada ulasan yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $ulasans->links('vendor.pagination.tailwind') }}
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="ulasanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Tambah Ulasan</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="ulasanForm">
                @csrf
                <input type="hidden" id="ulasan_id" name="ulasan_id">
                
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                </div>
                
                <div class="mb-4">
                    <label for="ulasan" class="block text-sm font-medium text-gray-700">Ulasan</label>
                    <textarea id="ulasan" name="ulasan" rows="4" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5 Bintang)</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Ulasan';
        document.getElementById('ulasanForm').reset();
        document.getElementById('ulasan_id').value = '';
        document.getElementById('ulasanModal').classList.remove('hidden');
    }

    function openEditModal(id) {
        document.getElementById('modalTitle').textContent = 'Edit Ulasan';
        
        fetch(`/ulasan/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('ulasan_id').value = data.id;
                document.getElementById('nama').value = data.nama;
                document.getElementById('ulasan').value = data.ulasan;
                document.getElementById('rating').value = data.rating;
                document.getElementById('ulasanModal').classList.remove('hidden');
            });
    }

    function closeModal() {
        document.getElementById('ulasanModal').classList.add('hidden');
    }

    document.getElementById('ulasanForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const id = formData.get('ulasan_id');
        const url = id ? `/ulasan/${id}` : '/ulasan';
        const method = id ? 'PUT' : 'POST';
        
        if (id) {
            formData.append('_method', 'PUT');
        }
        
        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat menyimpan data.'
            });
        });
    });

    function confirmDeleteUlasan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Ulasan ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/ulasan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
            }
        });
    }
</script>
@endsection