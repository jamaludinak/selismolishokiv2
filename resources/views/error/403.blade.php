<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-white flex items-center justify-center h-screen px-4">
    <div class="text-center">
        <div class="w-24 h-24 mx-auto mb-6">
            <!-- SVG Gembok -->
            <svg class="w-full h-full text-red-500" fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V7a4.5 4.5 0 10-9 0v3.5m1.5 0h6a1.5 1.5 0 011.5 1.5v6a1.5 1.5 0 01-1.5 1.5h-6a1.5 1.5 0 01-1.5-1.5v-6a1.5 1.5 0 011.5-1.5z" />
            </svg>
        </div>
        <h1 class="text-5xl font-bold text-red-400">403</h1>
        <p class="text-xl mt-4">Akses Ditolak</p>
        <p class="text-gray-400 mb-6">Anda tidak memiliki izin untuk membuka halaman ini.</p>
        <a href="{{ url()->previous() }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</body>

</html>
