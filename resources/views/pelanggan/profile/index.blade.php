@extends('pelanggan.layouts.app')
@section('title', 'Profile Pelanggan')

@section('content')
    <div class="container mx-auto py-2 px-2 sm:px-6 lg:px-2">
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
                        <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                        <input type="text" name="noHP" value="{{ old('noHP', $user->noHP) }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm bg-gray-100 cursor-not-allowed"
                            disabled>
                        <p class="mt-1 text-xs text-gray-500 italic">
                            <i class="fas fa-info-circle mr-1"></i>
                            Untuk mengubah nomor HP, silakan hubungi admin
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Password Baru (opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti"
                            class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengganti"
                            class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500">
                        <p class="mt-1 text-xs text-gray-500 italic">

                        </p>
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

    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-2">
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

        <div class="bg-white rounded shadow p-4 text-sm sm:text-base overflow-x-auto">
            <!-- Desktop Table View -->
            <div class="hidden md:block">
                <table class="min-w-full table-auto whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-200 text-left text-sm">
                            <th class="px-2 py-2">Alamat</th>
                            <th class="px-2 py-2">Lokasi</th>
                            <th class="px-2 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($alamats as $a)
                            <tr class="border-b">
                                <td class="px-2 py-2 break-words">{{ $a->alamat }}</td>
                                <td hidden class="px-2 py-2">{{ $a->longitude }}</td>
                                <td hidden class="px-2 py-2">{{ $a->latitude }}</td>
                                <td class="px-2 py-2">
                                    <a href="#" onclick="showMap({{ $a->latitude }}, {{ $a->longitude }})"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs sm:text-sm text-center block sm:inline-block">
                                        Lihat Lokasi
                                    </a>
                                </td>
                                <td class="px-2 py-2 flex flex-col sm:flex-row gap-1">
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
                                    @if (!$a->is_utama)
                                        <form action="{{ route('alamat.utama', $a->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs sm:text-sm text-center">
                                                Jadikan Alamat Utama
                                            </button>
                                        </form>
                                    @else
                                        <span class="bg-green-500 text-white px-3 py-1 rounded text-xs sm:text-sm text-center">
                                            Alamat Utama
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data alamat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($alamats as $a)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="space-y-3">
                            <!-- Alamat -->
                            <div>
                                <h3 class="font-semibold text-gray-800 text-sm mb-1">Alamat:</h3>
                                <p class="text-gray-700 text-sm break-words">{{ $a->alamat }}</p>
                            </div>

                            <!-- Status Alamat Utama -->
                            @if ($a->is_utama)
                                <div class="inline-block">
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-medium">
                                        <i class="fas fa-star mr-1"></i>Alamat Utama
                                    </span>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 pt-2">
                                <a href="#" onclick="showMap({{ $a->latitude }}, {{ $a->longitude }})"
                                    class="bg-green-500 text-white px-3 py-2 rounded text-xs font-medium hover:bg-green-600 transition-colors">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Lihat Lokasi
                                </a>
                                
                                <a href="{{ route('alamat.edit', $a->id) }}"
                                    class="bg-yellow-400 text-white px-3 py-2 rounded text-xs font-medium hover:bg-yellow-500 transition-colors">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                
                                <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" class="delete-form"
                                    data-entity="alamat">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-2 rounded text-xs font-medium hover:bg-red-700 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                                
                                @if (!$a->is_utama)
                                    <form action="{{ route('alamat.utama', $a->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-blue-500 text-white px-3 py-2 rounded text-xs font-medium hover:bg-blue-600 transition-colors">
                                            <i class="fas fa-star mr-1"></i>Jadikan Utama
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-map-marker-alt text-4xl mb-3 text-gray-300"></i>
                        <p class="text-sm">Belum ada data alamat.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Modal Map -->
        <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-40">
            <div class="bg-white rounded shadow-lg p-4 max-w-2xl w-full relative mx-4">
                <button onclick="closeMap()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
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

            const passwordField = document.querySelector('input[name="password"]');
            const confirmPasswordField = document.querySelector('input[name="password_confirmation"]');
            const submitButton = document.querySelector('button[type="submit"]');

            function validatePasswordMatch() {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;

                // Remove existing error styling
                passwordField.classList.remove('border-red-500');
                confirmPasswordField.classList.remove('border-red-500');

                // Check if both fields have values
                if (password && confirmPassword) {
                    if (password !== confirmPassword) {
                        confirmPasswordField.classList.add('border-red-500');
                        confirmPasswordField.setCustomValidity('Konfirmasi password tidak cocok');
                    } else {
                        confirmPasswordField.setCustomValidity('');
                    }
                } else if (password && !confirmPassword) {
                    confirmPasswordField.classList.add('border-red-500');
                    confirmPasswordField.setCustomValidity('Konfirmasi password harus diisi');
                } else if (!password && confirmPassword) {
                    passwordField.classList.add('border-red-500');
                    passwordField.setCustomValidity('Password baru harus diisi');
                } else {
                    // Both empty - clear validation
                    passwordField.setCustomValidity('');
                    confirmPasswordField.setCustomValidity('');
                }
            }

            // Add event listeners
            passwordField.addEventListener('input', validatePasswordMatch);
            confirmPasswordField.addEventListener('input', validatePasswordMatch);

            // Form submission validation
            document.querySelector('form').addEventListener('submit', function(e) {
                validatePasswordMatch();
                
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });
    </script>
@endpush
