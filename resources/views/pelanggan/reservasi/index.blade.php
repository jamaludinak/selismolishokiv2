@extends('pelanggan.layouts.app')
@section('title', 'Data Reservasi Servis')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Data Reservasi Servis</h1>
            <a href="{{ route('reservasi.create') }}"
                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-700 text-sm sm:text-base w-full sm:w-auto text-center">
                + Buat Reservasi
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow p-4 overflow-x-auto text-sm sm:text-base">
            <!-- Desktop Table View -->
            <div class="hidden md:block">
                <table class="min-w-full table-auto whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-200 text-left text-sm">
                            <th class="px-4 py-2">No. Resi</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Jenis Layanan</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservasis as $r)
                            <tr class="border-b text-sm">
                                <td class="px-4 py-2">{{ $r->no_resi }}</td>
                                <td class="px-4 py-2">{{ $r->namaLengkap }}</td>
                                <td class="px-4 py-2">{{ ucfirst($r->jenis_layanan) }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($r->waktuMulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($r->waktuSelesai)->format('H:i') }}</td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-1 rounded text-white text-xs sm:text-sm
                                        @if ($r->status == 'selesai') bg-green-600
                                        @elseif($r->status == 'proses') bg-yellow-500
                                        @else bg-gray-400 @endif">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('reservasi.show', $r->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs text-center">
                                        Detail
                                    </a>
                                    <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" class="delete-form"
                                        data-entity="reservasi">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs w-full text-center">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data reservasi servis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($reservasis as $r)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="space-y-3">
                            <!-- Header with No. Resi and Status -->
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1">No. Resi:</h3>
                                    <p class="text-gray-700 text-sm font-mono">{{ $r->no_resi }}</p>
                                </div>
                                <span
                                    class="px-2 py-1 rounded text-white text-xs font-medium
                                    @if ($r->status == 'selesai') bg-green-600
                                    @elseif($r->status == 'proses') bg-yellow-500
                                    @else bg-gray-400 @endif">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </div>

                            <!-- Reservation Details -->
                            <div class="space-y-2">
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Nama:</h4>
                                    <p class="text-gray-700 text-sm">{{ $r->namaLengkap }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Jenis Layanan:</h4>
                                    <p class="text-gray-700 text-sm">{{ ucfirst($r->jenis_layanan) }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Tanggal:</h4>
                                    <p class="text-gray-700 text-sm">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Waktu:</h4>
                                    <p class="text-gray-700 text-sm">{{ \Carbon\Carbon::parse($r->waktuMulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($r->waktuSelesai)->format('H:i') }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 pt-2">
                                <a href="{{ route('reservasi.show', $r->id) }}"
                                    class="bg-blue-500 text-white px-3 py-2 rounded text-xs font-medium hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                                
                                <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" class="delete-form"
                                    data-entity="reservasi">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-2 rounded text-xs font-medium hover:bg-red-700 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-check text-4xl mb-3 text-gray-300"></i>
                        <p class="text-sm">Belum ada data reservasi servis.</p>
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
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus reservasi ini?',
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
