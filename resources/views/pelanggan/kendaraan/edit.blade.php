<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-white rounded shadow p-8 mt-10">
        <h1 class="text-2xl font-bold mb-6">Edit Kendaraan</h1>
        <form method="POST" action="{{ route('kendaraan.update', $kendaraan->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Merk <span class="text-red-500">*</span></label>
                <input type="text" name="merk" value="{{ $kendaraan->merk }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Kendaraan <span class="text-red-500">*</span></label>
                <select name="jenis_kendaraan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="sepeda_listrik" {{ $kendaraan->jenis_kendaraan == 'sepeda_listrik' ? 'selected' : '' }}>Sepeda Listrik</option>
                    <option value="motor_listrik" {{ $kendaraan->jenis_kendaraan == 'motor_listrik' ? 'selected' : '' }}>Motor Listrik</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipe</label>
                <input type="text" name="tipe" value="{{ $kendaraan->tipe }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Rangka</label>
                <input type="text" name="nomor_rangka" value="{{ $kendaraan->nomor_rangka }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun Pembelian <span class="text-red-500">*</span></label>
                <input type="number" name="tahun_pembelian" value="{{ $kendaraan->tahun_pembelian }}" min="2000" max="{{ date('Y')+1 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('kendaraan.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html> 