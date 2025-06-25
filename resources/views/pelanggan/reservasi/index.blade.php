@extends('pelanggan.layouts.app')
@section('title', 'Data Reservasi Servis')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Data Reservasi Servis</h1>
            <a href="{{ route('reservasi.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">
                + Buat Reservasi
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded shadow p-4 overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-sm text-left">
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
                            <td class="px-4 py-2">{{ $r->waktuMulai }} - {{ $r->waktuSelesai }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 rounded text-white 
                                    @if ($r->status == 'selesai') bg-green-600
                                    @elseif($r->status == 'proses') bg-yellow-500
                                    @else bg-gray-400 @endif">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('reservasi.show', $r->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs">
                                    Detail
                                </a>
                                <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" class="delete-form"
                                    data-entity="reservasi">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs">
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
