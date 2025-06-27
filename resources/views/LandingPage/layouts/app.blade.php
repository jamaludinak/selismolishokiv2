<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="images/logofix2.png">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Link external CSS file -->
    @stack('css')
</head>

<body class="bg-gray-100">
    <div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <img src="{{ asset('images/logofix2.png') }}" alt="Loading..." class="w-24 h-24 animate-pulse">
    </div>
    @include('LandingPage.layouts.navbar')
    @yield('content')
    @include('LandingPage.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            loader.style.opacity = 0;
            loader.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => loader.style.display = 'none', 500);
        });
    </script>
    @stack('js')
</body>

</html>
