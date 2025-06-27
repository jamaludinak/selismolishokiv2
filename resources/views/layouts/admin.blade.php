<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logofix2.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-orange-600 text-white p-4 flex justify-between items-center fixed top-0 left-0 w-full z-30 shadow-md">
        <div class="flex items-center">
            <button id="sidebarToggle" class="text-white focus:outline-none md:hidden mr-4">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <a href="{{ route('dashboard') }}" class="text-white text-xl font-bold flex items-center">
                <img src="{{ asset('images/logofix1.jpg') }}" alt="Company Logo" class="rounded-full h-8 w-8 mr-2">
                Selis Molis Hoki
            </a>
        </div>
        <div class="hidden md:block text-lg font-semibold" id="currentDateTime">
            </div>
        <div class="flex items-center space-x-4">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-white hover:text-orange-200 transition duration-200">
                    <i class="fas fa-sign-out-alt text-xl"></i>
                </button>
            </form>
        </div>
    </header>

    <aside id="sidebar" class="fixed top-0 left-0 h-full bg-orange-700 text-white w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20 pt-16 shadow-lg">
        <div class="p-4 mt-4">
            <p class="text-orange-200 text-xs uppercase mb-4">Navigasi Utama</p>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('dashboard') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reservasi.index') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('admin.reservasi.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-clipboard-list mr-3"></i> Daftar Reservasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reservasi.history') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('admin.reservasi.history') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-history mr-3"></i> History Reservasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('jenis_kerusakan.index') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('jenis_kerusakan.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-tools mr-3"></i> Jenis Kerusakan
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwal.index') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('jadwal.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-calendar-alt mr-3"></i> Jadwal
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelanggan.index') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('pelanggan.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-users mr-3"></i> Data Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ route('pegawai.index') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('pegawai.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-user-tie mr-3"></i> Data Pegawai
                    </a>
                </li>
                <li>
                    <a href="{{ route('ulasan.index') }}" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('ulasan.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-star mr-3"></i> Ulasan
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 rounded-md hover:bg-orange-800 {{ request()->routeIs('pengaturan.index') ? 'bg-orange-800' : '' }}">
                        <i class="fas fa-cog mr-3"></i> Pengaturan
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="flex-1 transition-all duration-300 ease-in-out md:ml-64 p-6 mt-16">
        <div class="bg-white p-8 rounded-lg shadow-md min-h-[calc(100vh-8rem)]">
            @yield('content')
        </div>
    </div>

    <div id="sidebarBackdrop" class="fixed inset-0 bg-black opacity-50 z-10 hidden md:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const currentDateTime = document.getElementById('currentDateTime');

        // Function to open sidebar
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebarBackdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // Prevent scrolling body when sidebar is open
        }

        // Function to close sidebar
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden'); // Allow scrolling body again
        }

        // Toggle sidebar on button click
        sidebarToggle.addEventListener('click', () => {
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        // Close sidebar when clicking outside (on backdrop)
        sidebarBackdrop.addEventListener('click', () => {
            closeSidebar();
        });

        // Close sidebar when a menu item is clicked (for mobile UX)
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Check if the link is an anchor to the same page or an actual route
                if (link.getAttribute('href') && link.getAttribute('href') !== '#' && window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });

        // Adjust sidebar visibility on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // Desktop view
                sidebar.classList.remove('-translate-x-full');
                sidebarBackdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden'); // Ensure body scroll is enabled on desktop
            } else { // Mobile view
                // Ensure sidebar is initially hidden on mobile load/resize
                if (!sidebar.classList.contains('-translate-x-full') && !sidebarBackdrop.classList.contains('hidden')) {
                    // If sidebar is open, keep it open, but if it's supposed to be closed, ensure it is.
                    // This prevents sidebar from popping up unexpectedly on resize from desktop to mobile.
                    closeSidebar(); // Force close on resize to mobile if it was open.
                }
            }
        });

        // Initial check for mobile view on load
        if (window.innerWidth < 768) {
            sidebar.classList.add('-translate-x-full');
        }

        // Function to update current day, date, and time
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            currentDateTime.textContent = now.toLocaleDateString('id-ID', options);
        }

        // Update date and time every second
        setInterval(updateDateTime, 1000);

        // Initial call to display date and time immediately on load
        updateDateTime();
    </script>
    @stack('scripts')
</body>
</html>