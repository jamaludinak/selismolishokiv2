@extends('layouts.admin')

@section('title', 'Reservasi')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">History Reservasi</h2>

    <!-- Search and Filter Form -->
    <form class="mb-6 flex flex-wrap gap-2 items-center" method="GET" action="{{ route('reservasi.history') }}">
        <input 
            type="text" 
            name="searchResi" 
            placeholder="Cari No Resi" 
            class="border p-2 rounded-lg flex-1 min-w-[200px]" 
            value="{{ request('searchResi') }}" 
        />
    
        <input 
            type="text" 
            name="searchNama" 
            placeholder="Cari Nama" 
            class="border p-2 rounded-lg flex-1 min-w-[200px]" 
            value="{{ request('searchNama') }}" 
        />
    
        <input 
            type="text" 
            name="kodePelanggan" 
            placeholder="Cari Kode Pelanggan" 
            class="border p-2 rounded-lg flex-1 min-w-[200px]" 
            value="{{ request('kodePelanggan') }}" 
        />
    
        <select 
            name="jenisKerusakan" 
            class="border p-2 rounded-lg flex-1 min-w-[200px]"
        >
            <option value="">Semua Kerusakan</option>
            @foreach($jenisKerusakan as $jenis)
                <option value="{{ $jenis->id }}" {{ request('jenisKerusakan') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama }}
                </option>
            @endforeach
        </select>
    
        <button 
            type="submit" 
            class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600 w-full sm:w-auto"
        >
            Cari
        </button>
    </form>


    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr class="bg-orange-500 text-white">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama Lengkap</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">No Telp</th>
                    <th class="px-4 py-2 border">Jenis Kerusakan</th>
                    <th class="px-4 py-2 border">Servis</th>
                    <th class="px-4 py-2 border">No Resi</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservasis as $reservasi)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border">
                            {{ ($reservasis->currentPage() - 1) * $reservasis->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-2 border">{{ $reservasi->namaLengkap }}</td>
                        <td class="px-4 py-2 border">{{ $reservasi->alamatLengkap }}</td>
                        <td class="text-center px-4 py-2 border">
                            <a 
                                href="https://wa.me/62{{ ltrim(preg_replace('/[^0-9]/', '', $reservasi->noTelp), '0') }}" 
                                target="_blank" 
                                class="text-blue-500 hover:underline"
                            >
                                {{ $reservasi->noTelp }}
                            </a>
                        </td>
                        <td class="px-4 py-2 border">{{ $reservasi->jenisKerusakan->nama ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $reservasi->servis }}</td>
                        <td class="px-4 py-2 border">{{ $reservasi->noResi }}</td>
                        <td class="px-4 py-2 border flex space-x-2">
                            <a 
                                href="{{ route('reservasi.show', $reservasi->id) }}" 
                                class="bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 transition text-xs"
                            >
                                Detail
                            </a>
                            <a 
                                href="{{ route('reservasi.destroy', $reservasi->id) }}" 
                                class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 transition text-xs"
                                onclick="event.preventDefault(); if(confirm('Anda yakin ingin menghapus reservasi ini?')) { document.getElementById('delete-form-{{ $reservasi->id }}').submit(); }"
                            >
                                Hapus
                            </a>
                            <form id="delete-form-{{ $reservasi->id }}" action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-end">
    <ul class="flex space-x-2">
        {{-- Tombol Sebelumnya --}}
        @if ($reservasis->onFirstPage())
            <li class="px-3 py-1 bg-gray-300 text-gray-500 rounded">←</li>
        @else
            <li>
                <a href="{{ $reservasis->previousPageUrl() }}" class="px-3 py-1 bg-orange-500 text-white rounded hover:bg-orange-600">←</a>
            </li>
        @endif

        {{-- Nomor Halaman --}}
        @foreach (range(1, $reservasis->lastPage()) as $page)
            @if ($page == 1 || $page == $reservasis->lastPage() || 
                 abs($page - $reservasis->currentPage()) < 3)
                <li>
                    <a href="{{ $reservasis->url($page) }}" 
                       class="px-3 py-1 {{ $page == $reservasis->currentPage() ? 'bg-orange-600 text-white' : 'bg-gray-200' }} rounded hover:bg-orange-500 hover:text-white">
                        {{ $page }}
                    </a>
                </li>
            @elseif ($page == 2 || $page == $reservasis->lastPage() - 1)
                <li class="px-3 py-1">...</li>
            @endif
        @endforeach

        {{-- Tombol Berikutnya --}}
        @if ($reservasis->hasMorePages())
            <li>
                <a href="{{ $reservasis->nextPageUrl() }}" class="px-3 py-1 bg-orange-500 text-white rounded hover:bg-orange-600">→</a>
            </li>
        @else
            <li class="px-3 py-1 bg-gray-300 text-gray-500 rounded">→</li>
        @endif
    </ul>
</div>
</div>
@endsection
