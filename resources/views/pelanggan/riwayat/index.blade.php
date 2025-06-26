@extends('pelanggan.layouts.app')
@section('title', 'Riwayat Servis')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Riwayat Servis</h1>
        </div>

        <div class="bg-white rounded shadow p-4 overflow-x-auto text-sm sm:text-base">
            <table class="min-w-full table-auto whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm text-gray-700">
                        <th class="px-4 py-2">No. Resi</th>
                        <th class="px-4 py-2">Kode Kendaraan</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Garansi</th>
                        <th class="px-4 py-2">Berakhir</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayats as $r)
                        @php
                            $garansiAktif =
                                $r->tanggal_berakhir_garansi &&
                                \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->isFuture();
                            $statusGaransi = $garansiAktif ? 'Aktif' : 'Kadaluarsa';
                            $klaimSudahAda = $r->klaimGaransi !== null;
                        @endphp
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm sm:text-base">{{ $r->noResi }}</td>
                            <td class="px-4 py-2 text-sm sm:text-base">{{ $r->kendaraan->kode ?? '-' }}</td>
                            <td class="px-4 py-2 capitalize text-sm sm:text-base">{{ $r->status }}</td>
                            <td class="px-4 py-2 text-sm sm:text-base">
                                <span
                                    class="px-2 py-1 rounded text-white {{ $garansiAktif ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $statusGaransi }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm sm:text-base">
                                @if ($r->tanggal_berakhir_garansi)
                                    {{ \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->format('d-m-Y') }}
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-sm sm:text-base">
                                @if ($r->status === 'completed' && $garansiAktif && !$klaimSudahAda)
                                    <a href="{{ route('klaim-garansi.create', ['noResi' => $r->noResi]) }}"
                                        class="bg-orange-500 text-white px-2 py-1 rounded hover:bg-orange-700 text-xs sm:text-sm">
                                        Klaim Garansi
                                    </a>
                                @elseif ($klaimSudahAda)
                                    <span class="text-gray-500 text-xs sm:text-sm">Sudah Klaim</span>
                                @else
                                    <span class="text-gray-400 text-xs sm:text-sm">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 text-sm sm:text-base">
                                Belum ada riwayat servis.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
