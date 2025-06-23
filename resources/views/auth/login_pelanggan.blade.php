<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Login Pelanggan</h2>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ url('/login-pelanggan') }}" class="space-y-4">
            @csrf
            <div>
                <label for="noHP" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" id="noHP" name="noHP" required autofocus class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">Login</button>
        </form>
        <div class="mt-4 text-center text-sm">
            Belum punya akun? <a href="{{ url('/register-pelanggan') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
        </div>
    </div>
</body>
</html> 