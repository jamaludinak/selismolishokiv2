<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet"> <!-- Tambahkan Tailwind CSS -->
</head>
<body>
    <!-- Component -->
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url('/images/bengkel.jpg')">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-4xl font-bold text-white">Selis Molis HOKI</h2>
                        <p class="max-w-xl mt-3 text-gray-300">Membantu Penyebaran Kendaraan Listrik di Indonesia.</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Selis Molis HOKI</h2>
                        <p class="mt-3 text-gray-500 dark:text-gray-300">Create an account to get started</p>
                    </div>

                    <!-- Pesan Kesalahan -->
                    @if ($errors->any())
                        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-8">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Name</label>
                                <input type="text" id="name" name="name" placeholder="Your Name" value="{{ old('name') }}" required class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="example@example.com" value="{{ old('email') }}" required class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <label for="password" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Password</label>
                                <input type="password" id="password" name="password" placeholder="Your Password" required class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <label for="password_confirmation" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Your Password" required class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Register
                                </button>
                            </div>
                        </form>

                        <p class="mt-6 text-sm text-center text-gray-400">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 focus:outline-none focus:underline hover:underline">Sign in</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
