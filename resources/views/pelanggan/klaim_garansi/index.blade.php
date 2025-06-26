@extends('pelanggan.layouts.app')
@section('title', 'Klaim Garansi')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Daftar Klaim Garansi</h1>
            @if ($reservasis->isNotEmpty())
                <div>
                    <select onchange="location = this.value;"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-700 text-sm sm:text-base">
                        <option disabled selected>+ Klaim Garansi</option>
                        @foreach ($reservasis as $res)
                            <option value="{{ route('klaim-garansi.create', $res->noResi) }}">
                                {{ $res->noResi }} - {{ $res->kendaraan->kode ?? 'Tanpa Kode' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        <div class="bg-white rounded shadow p-4 overflow-x-auto text-sm sm:text-base">
            <table class="min-w-full table-auto whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm">
                        <th class="px-4 py-2">No. Resi</th>
                        <th class="px-4 py-2">Tanggal Klaim</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Bukti</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($klaimGaransis as $k)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $k->reservasi->noResi ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $k->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $k->keterangan ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if ($k->bukti)
                                    <a href="{{ asset('storage/' . $k->bukti) }}" target="_blank"
                                        class="text-blue-500 underline text-sm">Lihat</a>
                                @else
                                    <span class="text-gray-500 text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @php
                                    $statusClass = match ($k->status) {
                                        'diproses' => 'bg-yellow-400',
                                        'diterima' => 'bg-green-600',
                                        'ditolak' => 'bg-red-600',
                                        default => 'bg-gray-400',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded text-white {{ $statusClass }}">
                                    {{ ucfirst($k->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Belum ada klaim garansi.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
