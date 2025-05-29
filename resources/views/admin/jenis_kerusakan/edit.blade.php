@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Back Button at the Top Left -->
    <div class="flex justify-start mb-6">
    <a href="{{ route('jenis_kerusakan.index') }}" class="inline-block mb-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600">Kembali</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">Edit Jenis Kerusakan</h1>

    <!-- Form to Edit Jenis Kerusakan -->
    <form action="{{ route('jenis_kerusakan.update', $jenisKerusakan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Jenis Kerusakan Field -->
        <div class="flex flex-col">
            <label for="nama" class="mb-2 text-gray-700 font-semibold">Nama Jenis Kerusakan</label>
            <input type="text" name="nama" id="nama" class="border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-500" value="{{ $jenisKerusakan->nama }}" required>
        </div>

        <!-- Update Button -->
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200 mt-4">
            Perbarui
        </button>
    </form>
</div>
@endsection
