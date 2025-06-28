@extends('pelanggan.layouts.app')
@section('title', 'Data Kendaraan')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Data Kendaraan</h1>
            <a href="{{ route('kendaraan.create') }}"
                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-700 text-sm sm:text-base w-full sm:w-auto text-center">
                + Tambah Kendaraan
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow p-4 overflow-x-auto text-sm sm:text-base">
            <!-- Desktop Table View -->
            <div class="hidden md:block">
                <table class="min-w-full table-auto whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-200 text-left text-sm">
                            <th class="px-4 py-2">Merk</th>
                            <th class="px-4 py-2">Jenis</th>
                            <th class="px-4 py-2">Tipe</th>
                            <th class="px-4 py-2">Nomor Rangka</th>
                            <th class="px-4 py-2">Tahun Pembelian</th>
                            <th class="px-4 py-2">Status Garansi</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraans as $k)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $k->merk }}</td>
                                <td class="px-4 py-2 capitalize">{{ str_replace('_', ' ', $k->jenis_kendaraan) }}</td>
                                <td class="px-4 py-2">{{ $k->tipe ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $k->nomor_rangka ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $k->tahun_pembelian }}</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $k->status_garansi == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $k->status_garansi)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('kendaraan.edit', $k->id) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-xs sm:text-sm text-center">
                                        Edit
                                    </a>
                                    <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="delete-form"
                                        data-entity="kendaraan">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs sm:text-sm text-center">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data kendaraan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($kendaraans as $k)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="space-y-3">
                            <!-- Vehicle Details -->
                            <div class="space-y-2">
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Merk:</h3>
                                    <p class="text-gray-700 text-sm">{{ $k->merk }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Jenis:</h4>
                                    <p class="text-gray-700 text-sm capitalize">{{ str_replace('_', ' ', $k->jenis_kendaraan) }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Tipe:</h4>
                                    <p class="text-gray-700 text-sm">{{ $k->tipe ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Nomor Rangka:</h4>
                                    <p class="text-gray-700 text-sm font-mono">{{ $k->nomor_rangka ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Tahun Pembelian:</h4>
                                    <p class="text-gray-700 text-sm">{{ $k->tahun_pembelian }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Status Garansi:</h4>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $k->status_garansi == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $k->status_garansi)) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 pt-2">
                                <a href="{{ route('kendaraan.edit', $k->id) }}"
                                    class="bg-yellow-400 text-white px-3 py-2 rounded text-xs font-medium hover:bg-yellow-500 transition-colors">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                
                                <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="delete-form"
                                    data-entity="kendaraan">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="delete-btn bg-red-600 text-white px-3 py-2 rounded text-xs font-medium hover:bg-red-700 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-car text-4xl mb-3 text-gray-300"></i>
                        <p class="text-sm">Belum ada data kendaraan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Mencegah submit default

                    Swal.fire({
                        title: 'Yakin ingin menghapus alamat ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
