<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .logo {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        /* Mobile-specific styles */
        @media (max-width: 640px) {
            body {
                height: 100vh;
                overflow: hidden;
            }
            
            .mobile-container {
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0.5rem;
                margin: 0 0.5rem;
            }
            
            .mobile-form {
                width: 100%;
                max-height: 95vh;
                overflow-y: auto;
                padding: 1rem;
            }
            
            .mobile-input {
                font-size: 16px !important; /* Prevents zoom on iOS */
                padding: 14px 12px !important;
                min-height: 52px;
            }
            
            .mobile-button {
                min-height: 52px;
                font-size: 16px;
            }
            
            .mobile-card {
                width: 100%;
                max-width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center"
    style="background-image: url('{{ asset('images/bengkel.jpg') }}'); background-size: cover; background-position: center;">
    
    <div class="mobile-container mobile-card bg-white rounded-lg shadow-md p-4 sm:p-6 md:p-8">
        <div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
            <img src="{{ asset('images/logofix2.png') }}" alt="Loading..." class="w-24 h-24 animate-pulse">
        </div>
        
        <div class="mobile-form">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logofix2.png') }}" alt="Logo" class="logo">
            </div>

            <h2 class="text-xl sm:text-2xl font-bold text-center">Selis Molis Hoki</h2>
            <p class="text-xs sm:text-sm text-center mb-6">Membantu Penyebaran Kendaraan Listrik di Indonesia</p>
            
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center text-xs sm:text-sm">
                    {{ session('success') }}</div>
            @endif
            
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-xs sm:text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ url('/login-pelanggan') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="noHP" class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                    <input type="text" id="noHP" name="noHP" placeholder="08XXXXXXX" required autofocus
                        class="mobile-input block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-base">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="********" required
                            class="mobile-input block w-full px-3 py-3 pr-12 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-base">
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
                
                <button type="submit"
                    class="mobile-button w-full py-3 px-4 text-white bg-orange-500 hover:bg-orange-600 rounded-xl font-semibold transition-colors">
                    Masuk
                </button>
            </form>
            
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center text-sm space-y-2 sm:space-y-0">
                <div>
                    Belum punya akun?
                    <a href="{{ url('/register-pelanggan') }}" class="text-orange-600 hover:underline">
                        Daftar di sini
                    </a>
                </div>
                <div>
                    <a href="#" class="text-orange-600 hover:underline">
                        Lupa password?
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            loader.style.opacity = 0;
            loader.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => loader.style.display = 'none', 500);
        });
    </script>
    
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
    
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#f97316'
            });
        @endif
    </script>

</body>

</html>
