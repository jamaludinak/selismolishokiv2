@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Reservasi</h1>
        <a href="{{ route('reservasi.index') }}" class="inline-block mb-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600">Kembali</a>
    <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="servis" class="block font-semibold mb-2">Jenis Servis</label>
            <input type="text" name="servis" id="servis" class="w-full border p-2 rounded-lg" value="{{ $reservasi->servis }}" required>
        </div>

        <div class="form-group">
            <label for="namaLengkap" class="block font-semibold mb-2">Nama Lengkap</label>
            <input type="text" name="namaLengkap" id="namaLengkap" class="w-full border p-2 rounded-lg" value="{{ $reservasi->namaLengkap }}" required>
        </div>

        <div class="form-group">
            <label for="alamatLengkap" class="block font-semibold mb-2">Alamat Lengkap</label>
            <textarea name="alamatLengkap" id="alamatLengkap" class="w-full border p-2 rounded-lg" required>{{ $reservasi->alamatLengkap }}</textarea>
        </div>

        <div class="form-group">
            <label for="noTelp" class="block font-semibold mb-2">Nomor Telepon</label>
            <input type="text" name="noTelp" id="noTelp" class="w-full border p-2 rounded-lg" value="{{ $reservasi->noTelp }}" required>
        </div>

        <div class="form-group">
            <label for="idJenisKerusakan" class="block font-semibold mb-2">Jenis Kerusakan</label>
            <select name="idJenisKerusakan" id="idJenisKerusakan" class="w-full border p-2 rounded-lg" required>
                @foreach ($jenisKerusakan as $kerusakan)
                    <option value="{{ $kerusakan->id }}" {{ $reservasi->idJenisKerusakan == $kerusakan->id ? 'selected' : '' }}>
                        {{ $kerusakan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi" class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full border p-2 rounded-lg" required>{{ $reservasi->deskripsi }}</textarea>
        </div>

        <button type="submit" class="bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-yellow-600">Perbarui Reservasi</button>
    </form>
</div>
@endsection
