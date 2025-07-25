<!-- BACKDROP untuk mobile -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-40 z-30 hidden md:hidden" onclick="closeSidebar()">
</div>

<!-- SIDEBAR -->
<aside id="mobile-sidebar"
    class="md:translate-x-0 -translate-x-full fixed md:fixed top-0 left-0 h-full w-64 bg-white z-40 shadow-lg transform transition-transform duration-300 md:static md:flex md:flex-col p-4 space-y-6">
    <!-- Logo -->
    <div class="flex items-center">
        <a href="{{ route('dashboard.pelanggan') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logofix2.png') }}" alt="Logo" class="w-8 h-8 md:w-12 md:h-12 border-2 border-black rounded-full">
            <span class="text-base md:text-xl font-bold text-black">
                Selismolis <br> <span class="text-base md:text-xl font-bold">Hoki</span>
            </span>
        </a>
    </div>

    <!-- Menu -->
    <nav class="flex flex-col space-y-2 text-sm font-semibold text-gray-700 w-full">
        <a href="{{ route('dashboard.pelanggan') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard.pelanggan') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('reservasi.create') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('reservasi.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-calendar-check"></i> Reservasi
        </a>
        <a href="{{ route('riwayats.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('riwayats.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-clock"></i> Riwayat Reservasi
        </a>
        <a href="{{ route('klaim-garansi.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('klaim-garansi.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-shield-alt"></i> Garansi
        </a>
        <a href="{{ route('kendaraan.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('kendaraan.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-motorcycle"></i> Kendaraan
        </a>
    </nav>

    <div class="mt-auto w-full">
        <form method="POST" action="{{ route('logout.pelanggan') }}" class="logout-form">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-100 text-red-600 font-semibold w-full">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForm = document.querySelector('.logout-form');

            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Mencegah submit default

                    Swal.fire({
                        title: 'Yakin ingin logout?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            logoutForm.submit();
                        }
                    });
                });
            }
        });
        const sidebar = document.getElementById('mobile-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('sidebarToggle');
            toggleBtn?.addEventListener('click', openSidebar);
        });

        window.closeSidebar = closeSidebar;
    </script>
@endpush
