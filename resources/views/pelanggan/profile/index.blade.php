@extends('pelanggan.layouts.app')
@section('title', 'Profile Pelanggan')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Profil Pelanggan</h1>
        </div>

        {{-- Form Update Profil --}}
        <div class="bg-white rounded shadow p-6 mb-8">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm sm:text-base">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500"
                            required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Password Baru (opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti"
                            class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Data Alamat</h1>
            <a href="{{ route('alamat.create') }}"
                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-700 text-sm sm:text-base w-full sm:w-auto text-center">
                + Tambah Alamat
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow p-4 overflow-x-auto text-sm sm:text-base">
            <table class="min-w-full table-auto whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm">
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Longitude</th>
                        <th class="px-4 py-2">Latitude</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alamats as $a)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $a->alamat }}</td>
                            <td class="px-4 py-2">{{ $a->longitude }}</td>
                            <td class="px-4 py-2">{{ $a->latitude }}</td>
                            <td class="px-4 py-2">
                                <a href="#" onclick="showMap({{ $a->latitude }}, {{ $a->longitude }})"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs sm:text-sm text-center block sm:inline-block">
                                    Lihat Lokasi
                                </a>
                            </td>
                            <td class="px-4 py-2 flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('alamat.edit', $a->id) }}"
                                    class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-xs sm:text-sm text-center">
                                    Edit
                                </a>
                                <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" class="delete-form"
                                    data-entity="alamat">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs sm:text-sm w-full sm:w-auto text-center">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data alamat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal Map -->
        <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded shadow-lg p-4 max-w-2xl w-full relative">
                <button onclick="closeMap()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <div id="mapFrame" class="w-full h-96"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function showMap(lat, lng) {
            const url = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
            document.getElementById('mapFrame').innerHTML =
                `<iframe src="${url}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
            document.getElementById('mapModal').classList.remove('hidden');
        }

        function closeMap() {
            document.getElementById('mapModal').classList.add('hidden');
            document.getElementById('mapFrame').innerHTML = '';
        }
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
