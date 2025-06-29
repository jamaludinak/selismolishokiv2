@extends('layouts.admin')

@section('title', 'Kelola Klaim Garansi')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Kelola Klaim Garansi</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end" method="GET" action="{{ route('admin.klaim-garansi.index') }}">
            <div>
                <label for="search_no_resi" class="block text-sm font-medium text-gray-700">Cari No. Resi</label>
                <input
                    type="text"
                    name="search_no_resi"
                    id="search_no_resi"
                    placeholder="Cari berdasarkan no resi"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('search_no_resi') }}">
            </div>
            <div>
                <label for="search_pelanggan" class="block text-sm font-medium text-gray-700">Cari Pelanggan</label>
                <input
                    type="text"
                    name="search_pelanggan"
                    id="search_pelanggan"
                    placeholder="Cari berdasarkan nama pelanggan"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                    value="{{ request('search_pelanggan') }}">
            </div>
            <div>
                <label for="filter_status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                <select
                    name="status"
                    id="filter_status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    <option value="">Semua Status</option>
                    <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No Resi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Pelanggan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal Ajuan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal Diproses</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($klaimGaransis as $index => $klaim)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $klaimGaransis->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-orange-600">
                            {{ $klaim->reservasi->noResi ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $klaim->dataPelanggan->nama ?? $klaim->reservasi->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $klaim->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($klaim->status == 'diajukan')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Diajukan
                                </span>
                            @elseif($klaim->status == 'diterima')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Diterima
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $klaim->tanggal_diproses ? $klaim->tanggal_diproses->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.klaim-garansi.show', $klaim->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                                
                                @if($klaim->status == 'diajukan')
                                    <form action="{{ route('admin.klaim-garansi.approve', $klaim->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-900 transition duration-150 ease-in-out"
                                                onclick="return confirm('Yakin ingin menyetujui klaim ini?')">
                                            <i class="fas fa-check text-lg"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.klaim-garansi.reject', $klaim->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out"
                                                onclick="return confirm('Yakin ingin menolak klaim ini?')">
                                            <i class="fas fa-times text-lg"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-lg text-gray-500">
                            <i class="fas fa-file-alt text-4xl mb-3 text-gray-300"></i>
                            <p>Tidak ada data klaim garansi yang ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-6 md:hidden">
        @forelse($klaimGaransis as $index => $klaim)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 relative">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-lg font-bold text-gray-900">{{ $klaim->dataPelanggan->nama ?? $klaim->reservasi->nama ?? 'Pelanggan' }}</h3>
                    @if($klaim->status == 'diajukan')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Diajukan
                        </span>
                    @elseif($klaim->status == 'diterima')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Diterima
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            Ditolak
                        </span>
                    @endif
                </div>
                
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">No. Resi:</strong> <span class="font-mono text-orange-600">{{ $klaim->reservasi->noResi ?? '-' }}</span></p>
                <p class="text-gray-600 mb-1"><strong class="text-gray-800">Tanggal Ajuan:</strong> {{ $klaim->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-gray-600 mb-3"><strong class="text-gray-800">Tanggal Diproses:</strong> {{ $klaim->tanggal_diproses ? $klaim->tanggal_diproses->format('d/m/Y H:i') : '-' }}</p>

                <div class="flex space-x-3 mt-4">
                    <a href="{{ route('admin.klaim-garansi.show', $klaim->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md transition duration-300 hover:bg-blue-700">
                        <i class="fas fa-eye mr-2"></i> Detail
                    </a>
                    
                    @if($klaim->status == 'diajukan')
                        <form action="{{ route('admin.klaim-garansi.approve', $klaim->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-md transition duration-300 hover:bg-green-700"
                                    onclick="return confirm('Yakin ingin menyetujui klaim ini?')">
                                <i class="fas fa-check mr-2"></i> Setuju
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.klaim-garansi.reject', $klaim->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md transition duration-300 hover:bg-red-700"
                                    onclick="return confirm('Yakin ingin menolak klaim ini?')">
                                <i class="fas fa-times mr-2"></i> Tolak
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-file-alt text-4xl mb-3 text-gray-400"></i>
                <p class="text-lg">Tidak ada data klaim garansi yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $klaimGaransis->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection 