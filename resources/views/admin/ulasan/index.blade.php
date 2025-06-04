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
        <a href="{{ route('ulasan.create') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow-lg hover:bg-orange-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Ulasan
        </a>
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
                                <a href="{{ route('ulasan.edit', $ulasan->id) }}" class="text-yellow-600 hover:text-yellow-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <button type="button" onclick="confirmDeleteUlasan({{ $ulasan->id }})" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                                <form id="delete-ulasan-form-{{ $ulasan->id }}" action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
                    <a href="{{ route('ulasan.edit', $ulasan->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-md transition duration-300 hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <button type="button" onclick="confirmDeleteUlasan({{ $ulasan->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                    <form id="delete-ulasan-form-{{ $ulasan->id }}" action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-comments-slash text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Tidak ada ulasan yang ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
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
                document.getElementById('delete-ulasan-form-' + id).submit();
            }
        });
    }
</script>
@endsection