<header
    class="w-full bg-white h-16 fixed top-0 left-0 z-30 shadow-md flex items-center justify-between px-4 md:px-6 md:pl-64">
    <div class="flex items-center gap-3 w-full">
        <button id="sidebarToggle" class="md:hidden text-xl text-gray-700 focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
        <div class="text-sm md:text-xl text-gray-700 font-medium flex-grow md:px-10">
            Selamat Datang, <span
                class="font-bold text-black">{{ auth('pelanggan')->user()->nama ?? 'Pelanggan' }}!</span>
        </div>
    </div>
    <div class="flex items-center gap-3 text-gray-700 text-lg ml-auto md:px-10">
        <i class="fas fa-search cursor-pointer hover:text-orange-500"></i>
        <i class="fas fa-bell cursor-pointer hover:text-orange-500"></i>
        <i class="fas fa-user-circle cursor-pointer hover:text-orange-500"></i>
    </div>
</header>
