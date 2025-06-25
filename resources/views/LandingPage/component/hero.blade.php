<div id="carouselExample" class="relative w-full h-screen overflow-hidden">
    <!-- Slide 1 -->
    <div class="carousel-item absolute inset-0 bg-cover bg-center transition-all duration-700"
        style="background-image: url('images/mypict.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center">
            <div class="container mx-auto text-center text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selis Molis Hoki</h1>
                <h2 class="text-xl md:text-3xl font-bold mb-2">Servis Kendaraan Listrik dan Sepeda Listrik Purwokerto.
                </h2>
                <p class="text-base md:text-lg mb-4 md:mb-8">Perbaikan Sepeda Listrik Terpercaya, Cepat, dan Profesional.
                </p>
                <a href="#services"
                    class="slide-button bg-yellow-500 drop-shadow-lg text-white px-6 py-3 md:px-8 md:py-5 rounded-full text-sm md:text-lg hover:bg-yellow-600">Reservasi
                    Jadwal Servis Anda Sekarang</a>
            </div>
        </div>
    </div>
    <!-- Slide 2 -->
    <div class="carousel-item absolute inset-0 bg-cover bg-center transition-all duration-700"
        style="background-image: url('images/service.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center">
            <div class="container mx-auto text-center text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selis Molis Hoki</h1>
                <h1 class="text-xl md:text-3xl font-bold mb-2">Home Service dan Servis di Bengkel</h1>
                <p class="text-base md:text-lg mb-4 md:mb-8">Siap Melayani Dimana Saja, Kapan Saja!</p>
                <a href="#services"
                    class="slide-button bg-yellow-500 drop-shadow-2xl text-white px-6 py-3 md:px-8 md:py-5 rounded-full text-sm md:text-lg hover:bg-yellow-600">Servis
                    Sekarang</a>
            </div>
        </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-item absolute inset-0 bg-cover bg-center transition-all duration-700"
        style="background-image: url('images/bengkel.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center">
            <div class="container mx-auto text-center text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selis Molis Hoki</h1>
                <h1 class="text-xl md:text-3xl font-bold mb-2">Cek Status Perbaikan Anda</h1>
                <p class="text-base md:text-lg mb-4 md:mb-8">Ingin tahu status perbaikan kendaraan anda? klik tombol di
                    bawah ini</p>
                <a href="#cek-status"
                    class="slide-button bg-yellow-500 drop-shadow-2xl text-white px-6 py-3 md:px-8 md:py-5 rounded-full text-sm md:text-lg hover:bg-yellow-600 ">Cek
                    Status</a>
            </div>
        </div>
    </div>
</div>
<!-- Carousel Controls -->
<div class="absolute inset-y-1/2 left-4 transform -translate-y-1/2 text-3xl text-white cursor-pointer z-20 bg-black bg-opacity-50 rounded-full w-12 h-12 flex items-center justify-center hover:bg-opacity-80"
    id="prev">&lt;</div>
<div class="absolute inset-y-1/2 right-4 transform -translate-y-1/2 text-3xl text-white cursor-pointer z-20 bg-black bg-opacity-50 rounded-full w-12 h-12 flex items-center justify-center hover:bg-opacity-80"
    id="next">&gt;</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.carousel-item');
        let current = 0;
        const total = items.length;
        const showSlide = (idx) => {
            items.forEach((item, i) => {
                item.style.opacity = (i === idx) ? '1' : '0';
                item.style.zIndex = (i === idx) ? '10' : '0';
            });
        };
        showSlide(current);

        document.getElementById('next').addEventListener('click', function() {
            current = (current + 1) % total;
            showSlide(current);
        });
        document.getElementById('prev').addEventListener('click', function() {
            current = (current - 1 + total) % total;
            showSlide(current);
        });

        // Optional: Auto-slide every 5 seconds
        setInterval(() => {
            current = (current + 1) % total;
            showSlide(current);
        }, 8000);
    });
</script>
