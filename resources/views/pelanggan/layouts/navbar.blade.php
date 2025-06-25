<header class="w-full bg-white h-16 fixed top-0 left-0 z-30 shadow-md pl-64 pr-6 flex items-center justify-between">
    <div class="text-xl ms-6 text-gray-700">
        Selamat Datang, <span class="font-bold text-black">{{ auth('pelanggan')->user()->nama ?? 'Pelanggan' }}!</span>
    </div>
    <div class="flex items-center gap-4 text-gray-700 text-lg">
        <i class="fas fa-search cursor-pointer hover:text-orange-500"></i>
        <i class="fas fa-bell cursor-pointer hover:text-orange-500"></i>
        <i class="fas fa-user-circle cursor-pointer hover:text-orange-500"></i>
    </div>
</header>
