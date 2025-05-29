@extends('layouts.admin')

@section('title', 'Tambah Ulasan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Ulasan</h2>

    <form action="{{ route('ulasan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-sm font-semibold mb-1">Nama</label>
            <input type="text" class="border rounded-lg w-full p-2" id="nama" name="nama" required>
            @error('nama')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ulasan" class="block text-sm font-semibold mb-1">Ulasan</label>
            <textarea class="border rounded-lg w-full p-2" id="ulasan" name="ulasan" rows="4" required></textarea>
            @error('ulasan')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="rating" class="block text-sm font-semibold mb-1">Rating (1-5)</label>
            <input type="number" class="border rounded-lg w-full p-2" id="rating" name="rating" min="1" max="5" required>
            @error('rating')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">Simpan</button>
            <a href="{{ route('ulasan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">Kembali</a>
        </div>
    </form>
</div>
@endsection
