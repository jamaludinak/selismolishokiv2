<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Selis Molis Hoki - Bengkel Sepeda Listrik Terpercaya di Purwokerto')</title>
    <meta name="description" content="@yield('description', 'Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto. Layanan home service dan bengkel dengan teknisi profesional. Perbaikan cepat, berkualitas, dan terpercaya.')">
    <meta name="keywords" content="@yield('keywords', 'bengkel sepeda listrik, motor listrik, home service, purwokerto, perbaikan sepeda listrik, teknisi profesional, bengkel terpercaya')">
    <meta name="author" content="Selis Molis Hoki">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Selis Molis Hoki - Bengkel Sepeda Listrik Terpercaya di Purwokerto')">
    <meta property="og:description" content="@yield('og_description', 'Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto. Layanan home service dan bengkel dengan teknisi profesional.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/logofix1.jpg'))">
    <meta property="og:site_name" content="Selis Molis Hoki">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Selis Molis Hoki - Bengkel Sepeda Listrik Terpercaya')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto. Layanan home service dan bengkel dengan teknisi profesional.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logofix1.jpg'))">
    
    <!-- Local Business Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Selis Molis Hoki",
        "description": "Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto",
        "url": "{{ url('/') }}",
        "telephone": "+62-xxx-xxx-xxxx",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Purwokerto",
            "addressRegion": "Jawa Tengah",
            "addressCountry": "ID"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "-7.437347",
            "longitude": "109.264502"
        },
        "openingHours": "Mo-Su 08:00-20:00",
        "priceRange": "$$",
        "image": "{{ asset('images/logofix1.jpg') }}",
        "sameAs": [
            "https://www.instagram.com/selismolishokiofficial/"
        ]
    }
    </script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logofix2.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logofix2.png') }}">
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="{{ asset('images/logofix1.jpg') }}" as="image">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/tailwindcss@2/dist/tailwind.min.css" as="style">
    
    <!-- Critical CSS -->
    <style>
        /* Critical CSS for above-the-fold content */
        .hero-section { min-height: 100vh; }
        .loading { opacity: 0; transition: opacity 0.3s ease-in; }
        .loaded { opacity: 1; }
    </style>
    
    <!-- External CSS with async loading -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" media="print" onload="this.media='all'; this.onload=null;">
    <noscript><link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"></noscript>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" media="print" onload="this.media='all'; this.onload=null;">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"></noscript>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" media="print" onload="this.media='all'; this.onload=null;">
    <noscript><link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"></noscript>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Swiper JS - Load early for testimonials -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    
    <!-- Custom CSS -->
    @stack('css')
</head>

<body class="bg-gray-100">
    <!-- Loading Screen -->
    <div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <div class="text-center">
            <img src="{{ asset('images/logofix2.png') }}" alt="Selis Molis Hoki Loading" class="w-24 h-24 animate-pulse mx-auto mb-4">
            <p class="text-gray-600 font-semibold">Memuat...</p>
        </div>
    </div>
    
    <!-- Main Content -->
    <div id="main-content" class="loading">
        @include('LandingPage.layouts.navbar')
        @yield('content')
        @include('LandingPage.layouts.footer')
    </div>

    <!-- Deferred JavaScript Loading -->
    <script>
        // Optimize loading performance
        document.addEventListener('DOMContentLoaded', function() {
            // Hide loader and show content
            const loader = document.getElementById('loader');
            const mainContent = document.getElementById('main-content');
            
            if (loader && mainContent) {
                setTimeout(() => {
                    loader.style.opacity = '0';
                    mainContent.classList.remove('loading');
                    mainContent.classList.add('loaded');
                    setTimeout(() => loader.style.display = 'none', 300);
                }, 500);
            }
        });
        
        // Lazy load non-critical scripts
        function loadScript(src) {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }
        
        // Load scripts after page load
        window.addEventListener('load', function() {
            Promise.all([
                loadScript('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js'),
                loadScript('https://cdn.jsdelivr.net/npm/sweetalert2@11')
            ]).then(() => {
                console.log('All scripts loaded successfully');
            }).catch(error => {
                console.error('Error loading scripts:', error);
            });
        });
    </script>
    
    @stack('js')
</body>

</html>
