<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-700 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <span class="font-bold text-lg">Dashboard Pelanggan</span>
            <form method="POST" action="{{ url('/logout-pelanggan') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container mx-auto mt-10">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ auth('pelanggan')->user()->nama ?? 'Pelanggan' }}!</h1>
            <p class="mb-6 text-gray-700">Ini adalah halaman dashboard pelanggan. Silakan pilih menu di bawah untuk mengelola data Anda.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="#" class="block bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold p-6 rounded-lg text-center shadow transition">Data Kendaraan</a>
                <a href="#" class="block bg-green-100 hover:bg-green-200 text-green-800 font-semibold p-6 rounded-lg text-center shadow transition">Alamat</a>
                <a href="#" class="block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold p-6 rounded-lg text-center shadow transition">Reservasi</a>
            </div>
        </div>
    </div>
</body>
</html> 