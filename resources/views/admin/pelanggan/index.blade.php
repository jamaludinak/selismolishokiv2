@extends('layouts.admin')

@section('title', 'Pelanggan')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center sm:text-left">Data Pelanggan</h2>

    <!-- Tombol Tambah Data -->
    <div class="flex justify-center sm:justify-between items-center mb-4">
        <a href="{{ route('pelanggan.create') }}" 
           class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
            Tambah Data Pelanggan
        </a>
    </div>

    <!-- Form Pencarian -->
    <form class="mb-6 grid grid-cols-1 sm:grid-cols-4 gap-2" method="GET" action="{{ route('pelanggan.index') }}">
        <input 
            type="text" 
            name="searchKode" 
            placeholder="Cari Kode" 
            class="border p-2 rounded-lg" 
            value="{{ request('searchKode') }}">

        <input 
            type="text" 
            name="searchNama" 
            placeholder="Cari Nama" 
            class="border p-2 rounded-lg" 
            value="{{ request('searchNama') }}">

        <input 
            type="text" 
            name="searchNoHP" 
            placeholder="Cari No Telp" 
            class="border p-2 rounded-lg" 
            value="{{ request('searchNoHP') }}">

        <button 
            type="submit" 
            class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600 transition w-full sm:w-auto"
        >
            Cari
        </button>
    </form>

    <!-- Tabel Data Pelanggan -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border border-gray-200 text-sm sm:text-base">
            <thead>
                <tr class="bg-orange-500 text-white">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kode</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">No Telp</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Keluhan</th> <!-- Tambahkan ini -->
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataPelanggan as $index => $pelanggan)
                    <tr class="hover:bg-gray-100">
                        <td class="text-center px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="text-center px-4 py-2 border">{{ $pelanggan->kode }}</td>
                        <td class="text-center px-4 py-2 border">{{ $pelanggan->nama }}</td>
                        <td class="text-center px-4 py-2 border">
                            <a href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $pelanggan->noHP), '0') }}" 
                               target="_blank" 
                               class="text-blue-500 hover:underline">
                                {{ $pelanggan->noHP }}
                            </a>
                        </td>
                        <td class="px-4 py-2 border">{{ $pelanggan->alamat }}</td>
                        <td class="px-4 py-2 border">{{ $pelanggan->keluhan }}</td> <!-- Tambahkan ini -->
                        <td class="px-4 py-2 border">
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" 
                                   class="bg-yellow-400 text-gray-900 py-1 px-2 rounded hover:bg-yellow-500 transition text-xs">
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-center sm:justify-end">
        <ul class="flex space-x-2">
            {{-- Tombol Sebelumnya --}}
            @if ($dataPelanggan->onFirstPage())
                <li class="px-3 py-1 bg-gray-300 text-gray-500 rounded">←</li>
            @else
                <li>
                    <a href="{{ $dataPelanggan->previousPageUrl() }}" 
                       class="px-3 py-1 bg-orange-500 text-white rounded hover:bg-orange-600">←</a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach (range(1, $dataPelanggan->lastPage()) as $page)
                @if ($page == 1 || $page == $dataPelanggan->lastPage() || abs($page - $dataPelanggan->currentPage()) < 3)
                    <li>
                        <a href="{{ $dataPelanggan->url($page) }}" 
                           class="px-3 py-1 {{ $page == $dataPelanggan->currentPage() ? 'bg-orange-600 text-white' : 'bg-gray-200' }} rounded hover:bg-orange-500 hover:text-white">
                            {{ $page }}
                        </a>
                    </li>
                @elseif ($page == 2 || $page == $dataPelanggan->lastPage() - 1)
                    <li class="px-3 py-1">...</li>
                @endif
            @endforeach

            {{-- Tombol Berikutnya --}}
            @if ($dataPelanggan->hasMorePages())
                <li>
                    <a href="{{ $dataPelanggan->nextPageUrl() }}" 
                       class="px-3 py-1 bg-orange-500 text-white rounded hover:bg-orange-600">→</a>
                </li>
            @else
                <li class="px-3 py-1 bg-gray-300 text-gray-500 rounded">→</li>
            @endif
        </ul>
    </div>
</div>
@endsection
