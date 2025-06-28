@extends('pelanggan.layouts.app')
@section('title', 'Riwayat Servis')

@section('content')
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-xl sm:text-2xl font-bold">Riwayat Servis</h1>
        </div>

        <div class="bg-white rounded shadow p-4 overflow-x-auto text-sm sm:text-base">
            <!-- Desktop Table View -->
            <div class="hidden md:block">
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

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse ($riwayats as $r)
                    @php
                        $garansiAktif =
                            $r->tanggal_berakhir_garansi &&
                            \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->isFuture();
                        $statusGaransi = $garansiAktif ? 'Aktif' : 'Kadaluarsa';
                        $klaimSudahAda = $r->klaimGaransi !== null;
                    @endphp
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="space-y-3">
                            <!-- Header with No. Resi and Status -->
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm mb-1">No. Resi:</h3>
                                    <p class="text-gray-700 text-sm font-mono">{{ $r->noResi }}</p>
                                </div>
                                <span class="px-2 py-1 rounded text-white text-xs font-medium capitalize {{ $r->status === 'completed' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                    {{ $r->status }}
                                </span>
                            </div>

                            <!-- Service Details -->
                            <div class="space-y-2">
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Kode Kendaraan:</h4>
                                    <p class="text-gray-700 text-sm">{{ $r->kendaraan->kode ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Status Garansi:</h4>
                                    <span class="px-2 py-1 rounded text-white text-xs font-medium {{ $garansiAktif ? 'bg-green-600' : 'bg-red-600' }}">
                                        {{ $statusGaransi }}
                                    </span>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm mb-1">Berakhir Garansi:</h4>
                                    <p class="text-gray-700 text-sm">
                                        @if ($r->tanggal_berakhir_garansi)
                                            {{ \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->format('d-m-Y') }}
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="pt-2">
                                @if ($r->status === 'completed' && $garansiAktif && !$klaimSudahAda)
                                    <a href="{{ route('klaim-garansi.create', ['noResi' => $r->noResi]) }}"
                                        class="bg-orange-500 text-white px-3 py-2 rounded text-xs font-medium hover:bg-orange-700 transition-colors">
                                        <i class="fas fa-shield-alt mr-1"></i>Klaim Garansi
                                    </a>
                                @elseif ($klaimSudahAda)
                                    <span class="text-gray-500 text-xs font-medium">
                                        <i class="fas fa-check-circle mr-1"></i>Sudah Klaim
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs font-medium">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-history text-4xl mb-3 text-gray-300"></i>
                        <p class="text-sm">Belum ada riwayat servis.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
