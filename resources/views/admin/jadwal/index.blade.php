@extends('layouts.admin')

@section('title', 'Jadwal Reservasi')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center lg:text-left">Kalender Jadwal Reservasi</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Terjadi kesalahan:</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $startOfWeek = \Carbon\Carbon::parse($startOfWeek);
        $endOfWeek = \Carbon\Carbon::parse($endOfWeek);
    @endphp
    <div class="bg-white p-4 rounded-lg shadow-md mb-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
        <a href="{{ route('jadwal.index', ['week' => $startOfWeek->copy()->subWeek()->format('Y-m-d')]) }}"
           class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
            <i class="fas fa-chevron-left mr-2"></i> Minggu Sebelumnya
        </a>
        <h3 class="text-lg font-semibold text-gray-800 text-center">
            Periode: <span class="font-bold">{{ $startOfWeek->translatedFormat('d F Y') }}</span> - <span class="font-bold">{{ $endOfWeek->translatedFormat('d F Y') }}</span>
        </h3>
        <a href="{{ route('jadwal.index', ['week' => $startOfWeek->copy()->addWeek()->format('Y-m-d')]) }}"
           class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
            Minggu Berikutnya <i class="fas fa-chevron-right ml-2"></i>
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg hidden md:block">
        <table class="min-w-full divide-y divide-gray-200" style="table-layout: fixed;">
            <thead class="bg-orange-600">
                <tr>
                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" style="width: 10%;">Jam</th>
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $index => $day)
                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider" style="width: 12.85%;">
                            {{ $day }} <br> <span class="font-normal text-sm">{{ $startOfWeek->copy()->addDays($index)->format('d/m') }}</span>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @for ($i = 8; $i <= 20; $i++) {{-- Dari jam 08.00 hingga 20.00 --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 whitespace-nowrap text-center text-sm font-semibold text-gray-800 border-r border-gray-200">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</td>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $index => $day)
                            <td class="p-2 border-r border-gray-200 align-top">
                                @php
                                    $currentDate = $startOfWeek->copy()->addDays($index)->format('Y-m-d');
                                    $jadwalsInHour = $jadwals->filter(function($item) use ($currentDate, $i) {
                                        $waktuMulai = \Carbon\Carbon::parse($item->waktuMulai);
                                        $waktuSelesai = \Carbon\Carbon::parse($item->waktuSelesai);
                                        $startHour = $i;
                                        $endHour = $i + 1; // For current hour slot

                                        // Check if event starts or is ongoing within the current hour slot
                                        return $item->tanggal == $currentDate &&
                                               ($waktuMulai->hour == $startHour ||
                                               ($waktuMulai->hour < $startHour && $waktuSelesai->hour > $startHour));
                                    });
                                @endphp

                                @if ($jadwalsInHour->isNotEmpty())
                                    @foreach ($jadwalsInHour as $item)
                                        <div class="
                                            @if($item->reservasi->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($item->reservasi->status == 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($item->reservasi->status == 'process') bg-indigo-100 text-indigo-800
                                            @elseif($item->reservasi->status == 'completed') bg-green-100 text-green-800
                                            @elseif($item->reservasi->status == 'cancelled') bg-red-100 text-red-800
                                            @endif
                                            text-sm p-1 rounded-md mb-1 shadow-sm font-semibold">
                                            <div class="flex justify-between items-center">
                                                <span>{{ $item->reservasi->noResi }}</span>
                                                <span class="text-xs font-normal">
                                                    {{ \Carbon\Carbon::parse($item->waktuMulai)->format('H:i') }}-{{ \Carbon\Carbon::parse($item->waktuSelesai)->format('H:i') }}
                                                </span>
                                            </div>
                                            <div class="text-xs font-normal truncate mt-0.5">
                                                {{ $item->reservasi->namaLengkap }}
                                            </div>
                                            <div class="flex justify-end mt-1">
                                                <a href="{{ route('jadwal.edit', $item->id) }}" class="text-xs text-blue-700 hover:text-blue-900 transition mr-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button type="button" onclick="confirmDeleteJadwal({{ $item->id }})" class="text-xs text-red-700 hover:text-red-900 transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                                <form id="delete-jadwal-form-{{ $item->id }}" action="{{ route('jadwal.destroy', $item->id) }}" method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-gray-400 text-xs">Kosong</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-6 md:hidden mt-6">
        @php
            // Group schedules by date for card display
            $groupedJadwals = [];
            foreach ($jadwals as $jadwal) {
                $date = \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y');
                if (!isset($groupedJadwals[$date])) {
                    $groupedJadwals[$date] = [];
                }
                $groupedJadwals[$date][] = $jadwal;
            }
        @endphp

        @forelse ($groupedJadwals as $date => $dailySchedules)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">{{ $date }}</h3>
                <div class="space-y-4">
                    @foreach ($dailySchedules as $item)
                        <div class="
                            @if($item->reservasi->status == 'pending') bg-yellow-50 text-yellow-800 border-yellow-200
                            @elseif($item->reservasi->status == 'confirmed') bg-blue-50 text-blue-800 border-blue-200
                            @elseif($item->reservasi->status == 'process') bg-indigo-50 text-indigo-800 border-indigo-200
                            @elseif($item->reservasi->status == 'completed') bg-green-50 text-green-800 border-green-200
                            @elseif($item->reservasi->status == 'cancelled') bg-red-50 text-red-800 border-red-200
                            @endif
                            text-sm p-3 rounded-md border shadow-sm">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold">{{ $item->reservasi->noResi }}</span>
                                <span class="text-xs font-normal">
                                    <i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($item->waktuMulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->waktuSelesai)->format('H:i') }}
                                </span>
                            </div>
                            <p class="text-gray-700 truncate mb-1">{{ $item->reservasi->namaLengkap }}</p>
                            <p class="text-xs text-gray-500 italic">{{ $item->reservasi->jenisKerusakan->nama ?? 'N/A' }}</p>
                            <div class="flex justify-end mt-3 space-x-2">
                                <a href="{{ route('jadwal.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" onclick="confirmDeleteJadwal({{ $item->id }})" class="text-red-600 hover:text-red-800 transition">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-5 rounded-lg shadow-md text-center text-gray-600">
                <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
                <p class="text-lg">Tidak ada jadwal ditemukan untuk periode ini.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function confirmDeleteJadwal(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Jadwal ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-jadwal-form-' + id).submit();
            }
        });
    }
</script>
@endsection