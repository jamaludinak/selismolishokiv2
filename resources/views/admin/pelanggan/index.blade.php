@extends('layouts.admin')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Daftar Pelanggan</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex justify-start mb-6">
        <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow-lg hover:bg-orange-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-user-plus mr-2"></i> Tambah Pelanggan
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end" method="GET" action="{{ route('pelanggan.index') }}">
            <div>
                <label for="searchKode" class="block text-sm font-medium text-gray-700">Cari Kode</label>
                <input
                    type="text"
                    name="searchKode"
                    id="searchKode"
                    placeholder="Contoh: P123"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('searchKode') }}">
            </div>
            <div>
                <label for="searchNama" class="block text-sm font-medium text-gray-700">Cari Nama</label>
                <input
                    type="text"
                    name="searchNama"
                    id="searchNama"
                    placeholder="Contoh: Budi Santoso"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('searchNama') }}">
            </div>
            <div>
                <label for="searchNoHP" class="block text-sm font-medium text-gray-700">Cari No. HP</label>
                <input
                    type="text"
                    name="searchNoHP"
                    id="searchNoHP"
                    placeholder="Contoh: 0812xxxx"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('searchNoHP') }}">
            </div>
            <div class="col-span-1 md:col-span-3 lg:col-span-1 flex justify-end">
                <button
                    type="submit"
                    class="w-full md:w-auto bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-search mr-2"></i> Cari & Filter
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kode Pelanggan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No. HP</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Alamat</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Keluhan</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($dataPelanggan as $pelanggan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ ($dataPelanggan->currentPage() - 1) * $dataPelanggan->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-orange-600">{{ $pelanggan->kode }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pelanggan->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $pelanggan->noHP), '0') }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                {{ $pelanggan->noHP }} <i class="fab fa-whatsapp ml-2"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-700 max-w-xs truncate">{{ $pelanggan->alamat }}</td>
                        <td class="px-6 py-4 whitespace-wrap text-sm text-gray-700 max-w-xs truncate">{{ $pelanggan->keluhan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="text-yellow-600 hover:text-yellow-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <button type="button" onclick="confirmDeletePelanggan({{ $pelanggan->id }})" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                                <form id="delete-pelanggan-form-{{ $pelanggan->id }}" action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg text-gray-500">
                            <i class="fas fa-box-open text-4xl mb-3 text-gray-300"></i>
                            <p>Tidak ada pelanggan yang ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-6 md:hidden">
        @forelse ($dataPelanggan as $pelanggan)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pelanggan->nama }}</h3>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">Kode:</strong> <span class="font-mono text-orange-600">{{ $pelanggan->kode }}</span></p>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">Telepon:</strong>
                    <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $pelanggan->noHP), '0') }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ $pelanggan->noHP }} <i class="fab fa-whatsapp ml-1"></i>
                    </a>
                </p>
                <p class="text-gray-600 mb-1 break-words"><strong class="text-gray-800">Alamat:</strong> {{ $pelanggan->alamat }}</p>
                <p class="text-gray-600 mb-3 break-words"><strong class="text-gray-800">Keluhan:</strong> {{ $pelanggan->keluhan }}</p>

                <div class="flex space-x-3 mt-4">
                    <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-md transition duration-300 hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <button type="button" onclick="confirmDeletePelanggan({{ $pelanggan->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                    <form id="delete-pelanggan-form-{{ $pelanggan->id }}" action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-box-open text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Tidak ada pelanggan yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $dataPelanggan->links('vendor.pagination.tailwind') }}
    </div>
</div>

<script>
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
                document.getElementById('delete-pelanggan-form-' + id).submit();
            }
        });
    }
</script>
@endsection