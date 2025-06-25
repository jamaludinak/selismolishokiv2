<aside
    class="w-64 bg-white p-4 h-screen fixed top-0 left-0 z-40 flex flex-col items-start py-6 px-4 space-y-6 shadow-md">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/logofix2.png') }}" alt="Logo" class="w-10 h-10">
        <span class="text-xl font-bold text-black">Selismolis<br><span class="text-xl font-bold">Hoki</span></span>
    </div>
    <!-- Menu -->
    <nav class="flex flex-col space-y-2 text-sm font-semibold text-gray-700 w-full">
        <a href="{{ route('dashboard.pelanggan') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard.pelanggan') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="{{ route('reservasi.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('reservasi.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-calendar-check"></i> Reservasi
        </a>

        <a href="{{ route('alamat.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('alamat.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-location"></i> Alamat
        </a>
        <a href="{{ route('kendaraan.index') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('kendaraan.*') ? 'bg-orange-500 text-white' : 'hover:bg-orange-400' }}">
            <i class="fas fa-motorcycle"></i> Kendaraan
        </a>
        {{-- <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-orange-200 rounded-lg">
            <i class="fas fa-pen"></i> Ulasan
        </a> --}}
        {{-- <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-orange-200 rounded-lg">
            <i class="fas fa-random"></i> Trade In
        </a> --}}
        {{-- <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-orange-200 rounded-lg">
            <i class="fas fa-phone"></i> Garansi
        </a> --}}
        {{-- <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-orange-200 rounded-lg">
            <i class="fas fa-history"></i> Riwayat
        </a> --}}
    </nav>
    <div class="mt-auto w-full">
        <nav class="nav-footer">
            <form method="POST" action="{{ route('logout.pelanggan') }}" class="logout-form">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-100 text-red-600 font-semibold w-full">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
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
    </script>
@endpush
