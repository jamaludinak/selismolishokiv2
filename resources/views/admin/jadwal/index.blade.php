@extends('layouts.admin')

@section('title', 'Jadwal')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Jadwal Reservasi</h2>

    {{-- Tanggal Mingguan --}}
    @php
        $startOfWeek = \Carbon\Carbon::parse($startOfWeek);
        $endOfWeek = \Carbon\Carbon::parse($endOfWeek);
    @endphp
    <p class="text-lg font-semibold mb-4">Periode: {{ $startOfWeek->format('d') }} - {{ $endOfWeek->format('d M Y') }}</p>
    
    {{-- Tabel Jadwal --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 text-sm" style="table-layout: fixed;">
            <thead class="bg-orange-500 text-white">
                <tr>
                    <th class="px-3 py-2 border text-base text-center align-middle" style="width: 10%;">Jam</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Senin</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Selasa</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Rabu</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Kamis</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Jumat</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Sabtu</th>
                    <th class="px-3 py-2 border text-base" style="width: 12.85%;">Minggu</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 8; $i <= 20; $i++) {{-- Dari jam 08.00 hingga 20.00 --}}
                    <tr class="hover:bg-gray-100">
                        <td class="px-3 py-2 border text-base text-center align-middle">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</td>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $index => $day)
                            <td class="px-3 py-2 border text-base">
                                @php
                                    $currentDate = $startOfWeek->copy()->addDays($index)->format('Y-m-d');
                                    $jadwalsInHour = $jadwals->filter(function($item) use ($currentDate, $i) {
                                        return $item->tanggal == $currentDate && $item->waktuMulai <= str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00' && $item->waktuSelesai > str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00';
                                    });
                                @endphp

                                @if ($jadwalsInHour->isNotEmpty())
                                    @foreach ($jadwalsInHour as $item)
                                        <div class="bg-{{ $item->reservasi->servis == 'Home Service' ? 'blue' : 'orange' }}-500 text-white flex items-center p-2 rounded mb-1 text-sm">
                                            <strong class="mr-2">{{ $item->reservasi->noResi }}</strong>
                                            <form action="{{ route('jadwal.edit', $item->id) }}" method="GET" class="inline-block">
                                                <button type="submit" class="bg-yellow-500 text-white text-xs rounded px-2 py-1 hover:bg-yellow-600 transition focus:outline-none">Edit</button>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-gray-400 text-sm">Kosong</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- Tombol Pagination (Mingguan) --}}
    <div class="mt-4 flex justify-between">
        <a href="{{ route('jadwal.index', ['week' => $startOfWeek->copy()->subWeek()->format('Y-m-d')]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Minggu Sebelumnya</a>
        <a href="{{ route('jadwal.index', ['week' => $startOfWeek->copy()->addWeek()->format('Y-m-d')]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Minggu Berikutnya</a>
    </div>
</div>
@endsection
