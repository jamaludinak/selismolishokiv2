<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center h-screen px-4">
    <div class="text-center">
        <div class="w-24 h-24 mx-auto mb-6">
            <!-- SVG wajah bingung -->
            <svg class="w-full h-full text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 20.25c4.556 0 8.25-3.694 8.25-8.25S16.556 3.75 12 3.75 3.75 7.444 3.75 12s3.694 8.25 8.25 8.25z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 9.75h.008v.008H9V9.75zm6 0h.008v.008H15V9.75zm-6.75 4.5h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 010-1.5z" />
            </svg>
        </div>
        <h1 class="text-5xl font-bold text-yellow-400">404</h1>
        <p class="text-xl mt-4">Halaman Tidak Ditemukan</p>
        <p class="text-gray-400 mb-6">Ups! Sepertinya kamu nyasar ke halaman yang tidak ada.</p>
        <a href="{{ url()->previous() }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
            Kembali ke Beranda
        </a>
    </div>
</body>

</html>
