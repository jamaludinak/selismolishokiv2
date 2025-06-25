<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Riwayat Servis Saya</h1>
        <div class="bg-white rounded shadow p-4">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">No. Resi</th>
                        <th class="px-4 py-2">Tanggal Servis</th>
                        <th class="px-4 py-2">Jenis Kerusakan</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Garansi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $r)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $r->noResi }}</td>
                        <td class="px-4 py-2">{{ $r->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $r->jenisKerusakan->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ ucfirst($r->status) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-white {{ $r->status_garansi == 'Aktif' ? 'bg-green-600' : 'bg-red-600' }}">
                                {{ $r->status_garansi }}
                            </span>
                            @if($r->tanggal_berakhir_garansi)
                                <div class="text-xs text-gray-500">s/d {{ \Carbon\Carbon::parse($r->tanggal_berakhir_garansi)->format('d-m-Y') }}</div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada riwayat servis.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 