@extends('pelanggan.layouts.app')
@section('title', 'Dashboard Pelanggan')
@section('content')

    <div class=" grid grid-cols-2 p-4 md:grid-cols-4 gap-4 mb-6">
        <!-- Reservasi Servis -->
        <a href="{{ route('reservasi.index') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">📅</div>
            <div class="font-semibold text-sm mt-2">Reservasi</div>
        </a>

        <!-- Alamat -->
        <a href="{{ route('klaim-garansi.index') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">🛡️</div>
            <div class="font-semibold text-sm mt-2">Klaim Garansi</div>
        </a>

        <!-- Kendaraan -->
        <a href="{{ route('kendaraan.index') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">🏍️</div>
            <div class="font-semibold text-sm mt-2">Kendaraan</div>
        </a>
        <!-- Riwayat -->
        <a href="{{ route('riwayats.index') }}"
            class="text-center bg-white border border-orange-300 shadow hover:shadow-lg rounded-lg p-4 transition duration-200 hover:bg-orange-400">
            <div class="text-2xl">🕑</div>
            <div class="font-semibold text-sm mt-2">Riwayat</div>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4 mb-10">
        <!-- Total Servis -->
        <div class="bg-white border border-orange-200 rounded-md shadow p-4 text-center">
            <h3 class="font-bold text-lg text-gray-800 mb-2">Total Servis</h3>
            <p class="text-2xl text-orange-600 font-bold">{{ $totalServis }}</p>
        </div>

        <!-- Total Kendaraan -->
        <div class="bg-white border border-orange-200 rounded-md shadow p-4 text-center">
            <h3 class="font-bold text-lg text-gray-800 mb-2">Total Kendaraan</h3>
            <p class="text-2xl text-orange-600 font-bold">{{ $totalKendaraan }}</p>
        </div>

        <!-- Garansi Aktif -->
        <div class="bg-white border border-orange-200 rounded-md shadow p-4 text-center">
            <h3 class="font-bold text-lg text-gray-800 mb-2">Garansi Aktif</h3>
            <p class="text-2xl text-orange-600 font-bold">{{ $garansiAktif }}</p>
        </div>
    </div>

    <!-- Card Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4 mb-10">

        <!-- Garansi -->
        <div class="bg-white border border-orange-200 rounded-md shadow p-4 flex flex-col justify-between">
            @if ($lastServis && $lastServis->tanggal_berakhir_garansi && $lastServis->tanggal_berakhir_garansi >= now())
                <div>
                    <h3 class="font-bold text-lg mb-1 text-gray-800">Garansi Home Service</h3>
                    <p class="text-sm text-gray-600">Status garansi :
                        <strong class="text-black">Aktif</strong>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">Berlaku sampai :
                        <strong class="text-black">
                            {{ \Carbon\Carbon::parse($lastServis->tanggal_berakhir_garansi)->format('d M Y') }}
                        </strong>
                    </p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('klaim-garansi.index') }}"
                        class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded shadow flex items-center w-max">
                        ✏️&nbsp; lihat di sini
                    </a>
                </div>
            @else
                <div>
                    <h3 class="font-bold text-lg mb-1 text-gray-800">Garansi Home Service</h3>
                    <p class="text-sm text-gray-600">Status garansi : <strong class="text-black">Tidak Aktif</strong></p>
                    <p class="text-sm text-gray-600 mt-1">Berlaku sampai : <strong class="text-black">-</strong></p>
                </div>
            @endif
        </div>
        <!-- Servis Terakhir -->
        <div class="bg-white border border-orange-200 rounded-md shadow p-4 flex flex-col justify-between">
            @if ($lastServis)
                <div>
                    <h3 class="font-bold text-lg mb-1 text-gray-800">Servis Terakhir</h3>
                    <p><strong>{{ $lastServis->servis }}</strong> |
                        <span
                            class="text-gray-700">{{ \Carbon\Carbon::parse($lastServis->created_at)->format('d M Y') }}</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">Status :
                        <span class="text-black">{{ ucfirst($lastServis->status) }}</span>
                    </p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('riwayats.index') }}"
                        class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded shadow flex items-center w-max">
                        ✏️&nbsp; lihat di sini
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-sm">Belum ada servis yang tercatat.</p>
            @endif
        </div>
        <div class="bg-white border border-orange-300 rounded-md shadow p-4 flex flex-col justify-between">
            <h3 class="font-bold text-lg mb-3 text-gray-800">Kendaraan Saya</h3>

            <div class="space-y-3 text-sm text-gray-700">
                @forelse ($kendaraans as $kendaraan)
                    <div class="flex items-center space-x-3">
                        <div>
                            <p class="font-semibold">{{ $kendaraan->merk ?? 'Tanpa Nama' }}</p>
                            <p class="text-xs text-gray-600">Tahun Pembelian : {{ $kendaraan->tahun_pembelian ?? '-' }}</p>
                            <p class="text-xs text-gray-600">Riwayat Servis: {{ $kendaraan->reservasis()->count() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada kendaraan terdaftar.</p>
                @endforelse
            </div>

            <div class="mt-4">
                <a href="{{ route('kendaraan.index') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2 rounded shadow flex items-center w-max">
                    🛵&nbsp; lihat di sini
                </a>
            </div>
        </div>
    </div>
@endsection
