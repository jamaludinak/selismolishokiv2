<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alamat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Data Alamat</h1>
            <a href="{{ route('alamat.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Alamat</a>
        </div>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        <div class="bg-white rounded shadow p-4">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Longitude</th>
                        <th class="px-4 py-2">Latitude</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alamats as $a)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $a->alamat }}</td>
                        <td class="px-4 py-2">{{ $a->longitude }}</td>
                        <td class="px-4 py-2">{{ $a->latitude }}</td>
                        <td class="px-4 py-2">
                            <a href="#" onclick="showMap({{ $a->latitude }}, {{ $a->longitude }})" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Lihat Lokasi</a>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('alamat.edit', $a->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                            <form action="{{ route('alamat.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin hapus alamat?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data alamat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Modal Map -->
        <div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded shadow-lg p-4 max-w-2xl w-full relative">
                <button onclick="closeMap()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <div id="mapFrame" class="w-full h-96"></div>
            </div>
        </div>
        <script>
            function showMap(lat, lng) {
                const url = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
                document.getElementById('mapFrame').innerHTML = `<iframe src="${url}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
                document.getElementById('mapModal').classList.remove('hidden');
            }
            function closeMap() {
                document.getElementById('mapModal').classList.add('hidden');
                document.getElementById('mapFrame').innerHTML = '';
            }
        </script>
    </div>
</body>
</html> 