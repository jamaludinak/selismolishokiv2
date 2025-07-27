@extends('layouts.admin')

@section('title', 'Daftar Pegawai')

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div
            class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-white mb-2">Daftar Pegawai</h2>
                <p class="text-orange-100">Kelola data pegawai dan teknisi di sistem Anda</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <button onclick="openModal('createModal')"
                    class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 text-white font-semibold rounded-lg shadow-lg hover:bg-white hover:text-orange-600 transition duration-300 ease-in-out">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Pegawai
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md"
                role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden animate-fade-in">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php use Illuminate\Support\Str; @endphp
                    @foreach ($pegawai as $p)
                        <tr class="md:table-row block md:static border-b md:border-none">
                            <td class="px-6 py-4 whitespace-nowrap block md:table-cell">
                                <span class="inline-block md:hidden font-bold">Nama:</span>
                                {{ $p->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap block md:table-cell">
                                <span class="inline-block md:hidden font-bold">Email:</span>
                                <span class="block md:hidden">{{ Str::limit($p->email, 20) }}</span>
                                <span class="hidden md:inline-block">{{ $p->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap block md:table-cell">
                                <span class="inline-block md:hidden font-bold">Role:</span>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $p->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($p->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium block md:table-cell">
                                <span class="inline-block md:hidden font-bold">Aksi:</span>
                                <button
                                    onclick="openEditModal({{ $p->id }}, '{{ $p->name }}', '{{ $p->email }}', '{{ $p->role }}')"
                                    class="text-orange-600 hover:text-orange-900 mr-3">
                                    Edit
                                </button>
                                <button onclick="openDeleteModal({{ $p->id }})"
                                    class="text-red-600 hover:text-red-900">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Create Modal -->
        <div id="createModal" class="fixed inset-0 bg-gray-700 bg-opacity-60 flex items-center justify-center z-50 hidden">
            <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in">
                <div class="flex items-center mb-5">
                    <span class="bg-orange-100 text-orange-600 rounded-full p-2 mr-4">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <h3 class="text-xl font-semibold text-gray-900">Tambah Pegawai Baru</h3>
                </div>
                <form action="{{ route('pegawai.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="teknisi">Teknisi</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeModal('createModal')"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-semibold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 bg-gray-700 bg-opacity-60 flex items-center justify-center z-50 hidden">
            <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in">
                <div class="flex items-center mb-5">
                    <span class="bg-blue-100 text-blue-600 rounded-full p-2 mr-3">
                        <i class="fas fa-user-edit"></i>
                    </span>
                    <h3 class="text-xl font-semibold text-gray-900">Edit Pegawai</h3>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="edit_name" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="edit_email" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru <span
                                class="text-xs text-gray-400">(kosongkan jika tidak ingin mengubah)</span></label>
                        <input type="password" name="password"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" id="edit_role" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-2">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="teknisi">Teknisi</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeModal('editModal')"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-semibold">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal"
            class="fixed inset-0 bg-gray-700 bg-opacity-60 flex items-center justify-center z-50 hidden">
            <div class="w-full max-w-md mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in">
                <div class="flex items-center mb-5">
                    <span class="bg-red-100 text-red-600 rounded-full p-2 mr-3">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <h3 class="text-xl font-semibold text-gray-900">Konfirmasi Hapus</h3>
                </div>
                <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus pegawai ini?</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-3 mt-2">
                        <button type="button" onclick="closeModal('deleteModal')"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-semibold">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ...modal dan konten lain... -->

        @if ($errors->has('password'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: '{{ $errors->first('password') }}',
                    confirmButtonColor: '#f97316'
                });
            </script>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function openEditModal(id, name, email, role) {
            const form = document.getElementById('editForm');
            form.action = `/pegawai/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            openModal('editModal');
        }

        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = `/pegawai/${id}`;
            openModal('deleteModal');
        }
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
            }
        }
    </script>
@endpush
