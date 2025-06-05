@extends('layouts.admin')

@section('title', 'Jenis Kerusakan')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Daftar Jenis Kerusakan</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex justify-start mb-6">
        <a href="{{ route('jenis_kerusakan.create') }}"
           class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow-lg hover:bg-orange-700 transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Jenis Kerusakan
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Jenis Kerusakan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estimasi Biaya</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($jenisKerusakan as $kerusakan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $kerusakan->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kerusakan->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $kerusakan->biaya_estimasi ? 'Rp ' . number_format($kerusakan->biaya_estimasi, 0, ',', '.') : 'Belum ditentukan' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('jenis_kerusakan.edit', $kerusakan->id) }}" class="text-yellow-600 hover:text-yellow-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <button type="button" onclick="confirmDeleteJenisKerusakan({{ $kerusakan->id }})" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
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

    <div class="grid grid-cols-1 gap-6 md:hidden">
        @forelse ($jenisKerusakan as $kerusakan)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $kerusakan->nama }}</h3>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">ID:</strong> {{ $kerusakan->id }}</p>
                <p class="text-gray-600 mb-3"><strong class="text-gray-800">Estimasi Biaya:</strong>
                    {{ $kerusakan->biaya_estimasi ? 'Rp ' . number_format($kerusakan->biaya_estimasi, 0, ',', '.') : 'Belum ditentukan' }}
                </p>
                <div class="flex space-x-3 mt-4">
                    <a href="{{ route('jenis_kerusakan.edit', $kerusakan->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-md transition duration-300 hover:bg-yellow-600">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <button type="button" onclick="confirmDeleteJenisKerusakan({{ $kerusakan->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700">
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
</div>

<script>
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
</script>
@endsection