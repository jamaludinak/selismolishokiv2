<div class="container mx-auto text-center">
    <h2 class="text-2xl font-bold mt-8 mb-12 pt-8 text-gray-900">Layanan Servis Kami</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Home Service -->
        <article>
            <div class="bg-white p-8 rounded-lg drop-shadow-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('services.servis') }}" class="block">
                    <div class="overflow-hidden rounded-lg mb-6">
                        <img src="images/homeservice.jpg" alt="Servis Sepeda Listrik"
                            class="w-full h-48 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105">
                    </div>
                </a>
                <a href="{{ route('services.servis') }}" class="block">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-800 hover:text-gray-600">Home Service</h3>
                </a>
                <p class="text-black mb-6">
                    Layanan servis kendaraan listrik langsung di rumah Anda oleh teknisi profesional kami <span
                        class="font-bold">dengan biaya tambahan hanya 5rb/km</span>.
                </p>

                <a href="{{ route('services.servis') }}" style="background-color: #d97706"
                    class="inline-block text-white px-5 py-3 min-w-[200px] rounded-full text-lg transition-colors duration-300 text-center"
                    onmouseover="this.style.backgroundColor='#eab308'"
                    onmouseout="this.style.backgroundColor='#d97706'">
                    Reservasi sekarang
                </a>
            </div>
        </article>
        <!-- Servis di Bengkel  -->
        <article>
            <div
                class="bg-white p-8 rounded-lg drop-shadow-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('services.servisGarage') }}">
                    <div class="overflow-hidden rounded-lg mb-6">
                        <img src="images/garageservices.jpg" alt="Sparepart Sepeda Listrik"
                            class="w-full h-48 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105">
                    </div>
                </a>
                <a href="{{ route('services.servisGarage') }}" class="block">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-800 hover:text-gray-800">Servis di Bengkel</h3>
                </a>
                <p class="text-black mb-6">Servis secara mendalam kendaraan listrik Anda di bengkel kami dengan
                    peralatan yang lebih lengkap.</p>
                <a href="{{ route('services.servisGarage') }}" style="background-color: #d97706"
                    class="inline-block text-white px-5 py-3 min-w-[200px] rounded-full text-lg transition-colors duration-300 text-center"
                    onmouseover="this.style.backgroundColor='#eab308'"
                    onmouseout="this.style.backgroundColor='#d97706'">
                    Reservasi sekarang
                </a>
            </div>
        </article>
    </div>
</div>
