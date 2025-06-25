@extends('pelanggan.layouts.app')
@section('title', 'Data Kendaraan')
@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Data Kendaraan</h1>
            <a href="{{ route('kendaraan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+
                Tambah Kendaraan</a>
        </div>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        <div class="bg-white rounded shadow p-4">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Merk</th>
                        <th class="px-4 py-2">Jenis</th>
                        <th class="px-4 py-2">Tipe</th>
                        <th class="px-4 py-2">Nomor Rangka</th>
                        <th class="px-4 py-2">Tahun Pembelian</th>
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
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('kendaraan.edit', $k->id) }}"
                                    class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                                <form action="{{ route('kendaraan.destroy', $k->id) }}" method="POST" class="delete-form"
                                    data-entity="kendaraan">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="delete-btn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data kendaraan.</td>
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
