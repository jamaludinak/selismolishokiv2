@extends('layouts.admin')

@section('title', 'History Reservasi')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Riwayat Reservasi Selesai</h2>

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

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 items-end" method="GET" action="{{ route('admin.reservasi.history') }}">
            <div>
                <label for="searchResi" class="block text-sm font-medium text-gray-700">Cari No. Resi</label>
                <input
                    type="text"
                    name="searchResi"
                    id="searchResi"
                    placeholder="Contoh: HM-240528AA"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('searchResi') }}">
            </div>

            <div>
                <label for="searchNama" class="block text-sm font-medium text-gray-700">Cari Nama Pelanggan</label>
                <input
                    type="text"
                    name="searchNama"
                    id="searchNama"
                    placeholder="Contoh: Budi Santoso"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('searchNama') }}">
            </div>

            <div>
                <label for="kodePelanggan" class="block text-sm font-medium text-gray-700">Cari Kode Pelanggan</label>
                <input
                    type="text"
                    name="kodePelanggan"
                    id="kodePelanggan"
                    placeholder="Contoh: P123"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('kodePelanggan') }}">
            </div>

            <div>
                <label for="jenisKerusakan" class="block text-sm font-medium text-gray-700">Filter Jenis Kerusakan</label>
                <select
                    name="jenisKerusakan"
                    id="jenisKerusakan"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    <option value="">Semua Jenis Kerusakan</option>
                    @foreach($jenisKerusakan as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenisKerusakan') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-1 md:col-span-3 lg:col-span-1 flex justify-end">
                <button
                    type="submit"
                    class="w-full md:w-auto bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-md shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 gap-6 md:hidden">
        @forelse ($reservasis as $reservasi)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative">
                <div class="absolute top-3 right-3">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                        Selesai
                    </span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $reservasi->namaLengkap }}</h3>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">No. Resi:</strong> <span class="font-mono text-orange-600">{{ $reservasi->noResi }}</span></p>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">Jenis Servis:</strong> {{ $reservasi->servis }}</p>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">Jenis Kerusakan:</strong> {{ $reservasi->jenisKerusakan->nama ?? 'N/A' }}</p>
                <p class="text-gray-600 mb-1 break-words"><strong class="text-gray-800">Alamat:</strong> {{ $reservasi->alamatLengkap }}</p>
                <p class="text-gray-600 mb-3">
                    <strong class="text-gray-800">No. Telepon:</strong>
                    <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $reservasi->noTelp), '0') }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ $reservasi->noTelp }} <i class="fab fa-whatsapp ml-1"></i>
                    </a>
                </p>

                @if($reservasi->teknisi)
                    <p class="text-gray-600 mb-3">
                        <strong class="text-gray-800">Teknisi:</strong> 
                        <span class="text-green-600 font-semibold">{{ $reservasi->teknisi->name }}</span>
                    </p>
                @endif

                <div class="flex flex-col space-y-3 mt-5">
                    <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                        <i class="fas fa-info-circle mr-2"></i> Detail
                    </a>
                    <button type="button" onclick="confirmDeleteHistory({{ $reservasi->id }})" class="flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                    <form id="delete-history-form-{{ $reservasi->id }}" action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-box-open text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Tidak ada riwayat reservasi yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Lengkap</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Alamat</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No. Telp</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jenis Kerusakan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Servis</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No. Resi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Teknisi</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($reservasis as $reservasi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ ($reservasis->currentPage() - 1) * $reservasis->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $reservasi->namaLengkap }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 max-w-xs truncate">{{ $reservasi->alamatLengkap }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $reservasi->noTelp), '0') }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                {{ $reservasi->noTelp }} <i class="fab fa-whatsapp ml-2"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $reservasi->jenisKerusakan->nama ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $reservasi->servis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-orange-600">{{ $reservasi->noResi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            @if($reservasi->teknisi)
                                <span class="text-green-600 font-semibold">{{ $reservasi->teknisi->name }}</span>
                            @else
                                <span class="text-gray-500 italic">Tidak ada data</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                                <button type="button" onclick="confirmDeleteHistory({{ $reservasi->id }})" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                                <form id="delete-history-form-{{ $reservasi->id }}" action="{{ route('admin.reservasi.destroy', $reservasi->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-lg text-gray-500">
                            <i class="fas fa-box-open text-4xl mb-3 text-gray-300"></i>
                            <p>Tidak ada riwayat reservasi yang ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $reservasis->links('vendor.pagination.tailwind') }}
    </div>
</div>

<script>
    function confirmDeleteHistory(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Riwayat reservasi ini akan dihapus permanen! Ini juga akan menghapus jadwal terkait.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-history-form-' + id).submit();
            }
        });
    }
</script>
@endsection