@extends('layouts.admin')

@section('title', 'Riwayat')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Riwayat</h2>

    <form method="GET" action="#" class="mb-4 flex space-x-2">
        <input type="text" name="search_resi" placeholder="Cari No Resi" class="border p-2 rounded-lg" value="{{ request('search_resi') }}">
        <button type="submit" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600">Cari</button>
    </form>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-orange-500 text-white">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $riwayat)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $riwayat->id }}</td>
                        <td class="border px-4 py-2">{{ $riwayat->status }}</td>
                        <td class="border px-4 py-2">{{ $riwayat->created_at }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('riwayat.show', $riwayat->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-yellow-500 transition duration-200">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- End of responsive table -->
</div>
@endsection
