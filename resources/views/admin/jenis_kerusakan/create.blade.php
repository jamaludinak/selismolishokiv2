@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-10 p-4 sm:p-8 bg-white shadow-lg rounded-lg relative">
    <!-- Tombol Kembali -->
<a href="{{ route('jenis_kerusakan.index') }}" class="inline-block mb-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600">Kembali</a>

    <!-- Judul Halaman -->
    <h1 class="text-xl sm:text-2xl font-bold mb-6 text-center mt-12 sm:mt-0">Tambah Jenis Kerusakan</h1>

    <!-- Form -->
    <form action="{{ route('jenis_kerusakan.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Nama Jenis Kerusakan Field -->
        <div class="form-group">
            <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Jenis Kerusakan</label>
            <input 
                type="text" 
                name="nama" 
                id="nama" 
                class="form-control w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                placeholder="Masukkan nama jenis kerusakan" 
                required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-lg w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-200 ease-in-out">
            Simpan
        </button>
    </form>
</div>
@endsection
