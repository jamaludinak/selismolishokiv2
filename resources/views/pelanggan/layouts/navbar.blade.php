<header
    class="w-full bg-white h-16 fixed top-0 left-0 z-30 shadow-md flex items-center justify-between p-4 md:px-6 md:pl-64">
    <div class="flex items-center gap-3 w-full">
        <button id="sidebarToggle" class="md:hidden text-xl text-gray-700 focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <div class="text-sm md:text-xl text-gray-700 font-medium flex-grow md:px-9">
            Selamat Datang, <span
                class="font-bold text-black">{{ auth('pelanggan')->user()->nama ?? 'Pelanggan' }}!</span>
        </div>
    </div>
    <div class="flex items-center gap-3 text-gray-700 text-lg md:text-xl ml-auto md:px-4">
        <a href="{{ route('profile.index') }}"
            class="{{ request()->routeIs('profile.index') ? 'text-orange-500' : '' }}">
            <i class="fas fa-user-circle cursor-pointer hover:text-orange-500"></i>
        </a>
    </div>
</header>
