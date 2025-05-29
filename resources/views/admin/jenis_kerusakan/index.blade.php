@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Daftar Jenis Kerusakan</h2>

    <!-- Flexbox to properly align the button -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('jenis_kerusakan.create') }}" 
           class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">
            Tambah Jenis Kerusakan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr class="bg-orange-500 text-white">
                    <th class="px-4 py-2 border text-center">ID</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jenisKerusakan as $kerusakan)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="px-4 py-2 border text-center">{{ $kerusakan->id }}</td>
                        <td class="px-4 py-2 border">{{ $kerusakan->nama }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('jenis_kerusakan.edit', $kerusakan->id) }}" 
                               class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200 inline-block">
                                Edit
                            </a>
                            <form action="{{ route('jenis_kerusakan.destroy', $kerusakan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">Tidak ada data jenis kerusakan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection
