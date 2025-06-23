<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Learning Universitas Proklamasi 45</title>
    <link rel="icon" href="{{ asset('images/logoup45.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Background Image */
        body {
            background: url('{{ asset('images/bg_login.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="bg-white bg-opacity-90 rounded-lg shadow-lg p-8 w-full max-w-md">
        <!-- Logo -->
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo UP45" class="mx-auto w-24 mb-4">
            <h2 class="text-xl font-bold text-gray-800">E-Learning<br>Universitas Proklamasi 45</h2>
        </div>
        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                <ul class="list-disc list-inside font-bold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Form Login -->
        <form action="{{ route('login') }}" method="post" class="space-y-4 mt-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 pr-10">
                    <!-- Eye Icon for Show Password -->
                    <span onclick="togglePassword()"
                        class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="w-6 h-6 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.42 15.42A5 5 0 018.58 8.58M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                </div>
                <div>
                    <a href="#" class="text-sm text-orange-600 hover:text-orange-500">Lupa Password?</a>
                </div>
            </div>
            <button type="submit"
                class="w-full bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                MASUK
            </button>
        </form>

        <!-- Divider -->
        <div class="my-6 flex items-center">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-4 text-gray-500">Atau</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <!-- Google Login Button -->
        <a href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center bg-transparent border border-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
            <i class="fab fa-google mr-2"></i>
            Masuk dengan Google
        </a>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z M14.83 14.83a4 4 0 00-5.66-5.66M10 10l4 4m-4 0l4-4" />';
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M15.42 15.42A5 5 0 018.58 8.58M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" />';
            }
        }
    </script>
</body>

</html>
