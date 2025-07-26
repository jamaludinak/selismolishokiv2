@extends('layouts.admin')

@section('title', 'Daftar Pelanggan')

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">

        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-white mb-2">Daftar Pelanggan</h2>
                    <p class="text-orange-100">Kelola informasi pelanggan dan riwayat keluhan mereka</p>
                </div>
                <button onclick="openCreateModal()"
                    class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-white text-orange-600 font-semibold rounded-lg shadow-md hover:bg-gray-50 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Pelanggan
                </button>
            </div>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md"
                role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- JS Filter Input -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex-1">
                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search mr-1 text-orange-500"></i> Cari Pelanggan
                </label>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, kode, atau no HP..."
                        class="search-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                </div>
            </div>
        </div>

        <!-- Pelanggan List -->
        <div id="pelangganList">
            <!-- Desktop Table -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block animate-fade-in">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-orange-600">
                        <tr>
                            @foreach (['No', 'Kode Pelanggan', 'Nama', 'No. HP', 'Alamat', 'Keluhan', 'Aksi'] as $header)
                                <th
                                    class="px-6 py-4 {{ $header == 'Aksi' ? 'text-center' : 'text-left' }} text-xs font-medium text-white uppercase tracking-wider">
                                    {{ $header }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($dataPelanggan as $pelanggan)
                            <tr class="hover:bg-gray-50 pelanggan-item" data-nama="{{ strtolower($pelanggan->nama) }}"
                                data-kode="{{ strtolower($pelanggan->kode) }}" data-hp="{{ strtolower($pelanggan->noHP) }}">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ ($dataPelanggan->currentPage() - 1) * $dataPelanggan->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm font-mono text-orange-600">{{ $pelanggan->kode }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $pelanggan->nama }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $pelanggan->noHP), '0') }}"
                                        target="_blank" class="text-blue-600 hover:underline flex items-center">
                                        {{ $pelanggan->noHP }} <i class="fab fa-whatsapp ml-2"></i>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">
                                    {{ $pelanggan->alamatPelanggan->first()->alamat ?? 'Tidak ada alamat' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">
                                    {{ $pelanggan->keluhan }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button onclick="openEditModal({{ $pelanggan->id }})"
                                            class="text-yellow-600 hover:text-yellow-900 transition duration-150">
                                            <i class="fas fa-edit text-lg"></i>
                                        </button>
                                        <button type="button" onclick="confirmDeletePelanggan({{ $pelanggan->id }})"
                                            class="text-red-600 hover:text-red-900 transition duration-150">
                                            <i class="fas fa-trash-alt text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-500">
                                    <i class="fas fa-box-open text-4xl mb-2 text-gray-300"></i>
                                    <p class="text-lg">Tidak ada pelanggan yang ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="grid grid-cols-1 gap-6 md:hidden animate-fade-in">
                @forelse ($dataPelanggan as $pelanggan)
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative pelanggan-item"
                        data-nama="{{ strtolower($pelanggan->nama) }}" data-kode="{{ strtolower($pelanggan->kode) }}"
                        data-hp="{{ strtolower($pelanggan->noHP) }}">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pelanggan->nama }}</h3>
                        <p class="text-gray-600"><strong>Kode:</strong> <span
                                class="font-mono text-orange-600">{{ $pelanggan->kode }}</span></p>
                        <p class="text-gray-600"><strong>Telepon:</strong>
                            <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $pelanggan->noHP), '0') }}"
                                target="_blank" class="text-blue-600 hover:underline">
                                {{ $pelanggan->noHP }} <i class="fab fa-whatsapp ml-1"></i>
                            </a>
                        </p>
                        <p class="text-gray-600"><strong>Alamat:</strong>
                            {{ $pelanggan->alamatPelanggan->first()->alamat ?? 'Tidak ada alamat' }}</p>
                        <p class="text-gray-600 mb-4"><strong>Keluhan:</strong> {{ $pelanggan->keluhan }}</p>
                        <div class="flex space-x-3">
                            <button onclick="openEditModal({{ $pelanggan->id }})"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </button>
                            <button onclick="confirmDeletePelanggan({{ $pelanggan->id }})"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                        <i class="fas fa-box-open text-4xl mb-3 text-gray-400"></i>
                        <p class="text-lg">Tidak ada pelanggan yang ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('admin.pelanggan._modal')

@endsection
<script>

    const searchInput = document.getElementById('searchInput');
    const pelangganItems = document.querySelectorAll('.pelanggan-item');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        pelangganItems.forEach(item => {
            const nama = item.getAttribute('data-nama');
            const kode = item.getAttribute('data-kode');
            const hp = item.getAttribute('data-hp');

            if (nama.includes(query) || kode.includes(query) || hp.includes(query)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    });


    function openCreateModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Pelanggan';
        document.getElementById('pelangganForm').reset();
        document.getElementById('pelanggan_id').value = '';
        document.getElementById('pelangganModal').classList.remove('hidden');
    }

    function openEditModal(id) {
        document.getElementById('modalTitle').textContent = 'Edit Pelanggan';

        fetch(`/pelanggan/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('pelanggan_id').value = data.id;
                document.getElementById('nama').value = data.nama;
                document.getElementById('noHP').value = data.noHP;
                document.getElementById('alamat').value = data.alamatPelanggan[0] ? data.alamatPelanggan[0].alamat : '';
                document.getElementById('keluhan').value = data.keluhan;
                document.getElementById('pelangganModal').classList.remove('hidden');
            });
    }

    function closeModal() {
        document.getElementById('pelangganModal').classList.add('hidden');
    }

    document.getElementById('pelangganForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const id = formData.get('pelanggan_id');
        const url = id ? `/pelanggan/${id}` : '/pelanggan';
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

    function confirmDeletePelanggan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pelanggan ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/pelanggan/${id}`, {
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