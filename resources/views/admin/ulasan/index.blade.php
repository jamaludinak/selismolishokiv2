@extends('layouts.admin')

@section('title', 'Ulasan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Ulasan</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0">
        <a href="{{ route('ulasan.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-200">Tambah Ulasan</a>

        <form method="GET" action="{{ route('ulasan.index') }}" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" name="search_nama" placeholder="Cari Nama" class="border p-2 rounded-lg flex-grow" value="{{ request('search_nama') }}">
            <select name="filter_rating" class="border p-2 rounded-lg">
                <option value="">Filter Rating</option>
                <option value="1" {{ request('filter_rating') == 1 ? 'selected' : '' }}>1 Bintang</option>
                <option value="2" {{ request('filter_rating') == 2 ? 'selected' : '' }}>2 Bintang</option>
                <option value="3" {{ request('filter_rating') == 3 ? 'selected' : '' }}>3 Bintang</option>
                <option value="4" {{ request('filter_rating') == 4 ? 'selected' : '' }}>4 Bintang</option>
                <option value="5" {{ request('filter_rating') == 5 ? 'selected' : '' }}>5 Bintang</option>
            </select>
            <button type="submit" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600">Cari</button>
        </form>
    </div>

    <!-- Responsive Table Wrapper -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full mt-4 border-collapse hidden md:table">
            <thead>
                <tr class="bg-orange-500 text-white">
                    <th class="px-4 py-2">
                        <a href="{{ route('ulasan.index', ['sort' => 'nama']) }}" class="hover:underline">Nama</a>
                    </th>
                    <th class="px-4 py-2">Ulasan</th>
                    <th class="px-4 py-2">Rating</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($ulasans->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center border px-4 py-2">Tidak ada ulasan ditemukan.</td>
                    </tr>
                @else
                    @foreach($ulasans as $ulasan)
                        <tr class="bg-white hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $ulasan->nama }}</td>
                            <td class="border px-4 py-2">{{ $ulasan->ulasan }}</td>
                            <td class="border px-4 py-2">{{ $ulasan->rating }}</td>
                            <td class="border px-4 py-2 flex space-x-2">
                                <a href="{{ route('ulasan.edit', $ulasan->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200">Edit</a>
                                <form action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <!-- Mobile View -->
        <div class="md:hidden">
            @if($ulasans->isEmpty())
                <div class="text-center border px-4 py-2">Tidak ada ulasan ditemukan.</div>
            @else
                @foreach($ulasans as $ulasan)
                    <div class="bg-white border p-4 mb-4 rounded shadow-md">
                        <h3 class="font-bold">{{ $ulasan->nama }}</h3>
                        <p class="text-gray-700">{{ $ulasan->ulasan }}</p>
                        <p class="font-semibold">Rating: {{ $ulasan->rating }}</p>
                        <div class="flex space-x-2 mt-2">
                            <a href="{{ route('ulasan.edit', $ulasan->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200">Edit</a>
                            <form action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
