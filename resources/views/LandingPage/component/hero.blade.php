<div id="carouselExample" class="relative w-full h-screen overflow-hidden">
    <!-- Slide 1 -->
    <div class="carousel-item absolute inset-0 bg-cover bg-center transition-all duration-700"
        style="background-image: url('{{ asset('images/mypict.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center">
            <div class="container mx-auto text-center text-white px-4">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selis Molis Hoki</h1>
                <h2 class="text-xl md:text-3xl font-bold mb-2">Servis Kendaraan Listrik dan Sepeda Listrik Purwokerto.
                </h2>
                <p class="text-base md:text-lg mb-4 md:mb-8">Perbaikan Sepeda Listrik Terpercaya, Cepat, dan Profesional.
                </p>
                <a href="#services"
                    class="slide-button bg-yellow-500 drop-shadow-lg text-white px-6 py-3 md:px-8 md:py-5 rounded-full text-sm md:text-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105">Reservasi
                    Jadwal Servis Anda Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item absolute inset-0 bg-cover bg-center transition-all duration-700"
        style="background-image: url('{{ asset('images/service.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center">
            <div class="container mx-auto text-center text-white px-4">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selis Molis Hoki</h1>
                <h1 class="text-xl md:text-3xl font-bold mb-2">Home Service dan Servis di Bengkel</h1>
                <p class="text-base md:text-lg mb-4 md:mb-8">Siap Melayani Dimana Saja, Kapan Saja!</p>
                <a href="#services"
                    class="slide-button bg-yellow-500 drop-shadow-2xl text-white px-6 py-3 md:px-8 md:py-5 rounded-full text-sm md:text-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105">Servis
                    Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item absolute inset-0 bg-cover bg-center transition-all duration-700"
        style="background-image: url('{{ asset('images/bengkel.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center">
            <div class="container mx-auto text-center text-white px-4">
                <h1 class="text-3xl md:text-5xl font-bold mb-2">Selis Molis Hoki</h1>
                <h1 class="text-xl md:text-3xl font-bold mb-2">Cek Status Perbaikan Anda</h1>
                <p class="text-base md:text-lg mb-4 md:mb-8">Ingin tahu status perbaikan kendaraan anda? klik tombol di
                    bawah ini</p>
                <a href="#cek-status"
                    class="slide-button bg-yellow-500 drop-shadow-2xl text-white px-6 py-3 md:px-8 md:py-5 rounded-full text-sm md:text-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105">Cek
                    Status</a>
            </div>
        </div>
    </div>
</div>
<!-- Pop-up Modal -->
<div id="promoPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/3 lg:w-1/4 xl:w-1/5 2xl:w-1/6 mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Fitur Baru: Buat Akun Sekarang!</h2>
            <button id="closePopup"
                class="text-gray-600 hover:text-gray-900 transition duration-300 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="text-gray-600 mb-4">Nikmati seluruh kelebihan dan kemudahan yang kami tawarkan dengan membuat akun
            sekarang juga.</p>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('register.pelanggan') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>
<!-- Carousel Controls -->
<div class="absolute inset-y-1/2 left-4 transform -translate-y-1/2 text-3xl text-white cursor-pointer z-20 bg-black bg-opacity-50 rounded-full w-12 h-12 flex items-center justify-center hover:bg-opacity-80 transition-all duration-300"
    id="prev" aria-label="Slide sebelumnya">&lt;</div>
<div class="absolute inset-y-1/2 right-4 transform -translate-y-1/2 text-3xl text-white cursor-pointer z-20 bg-black bg-opacity-50 rounded-full w-12 h-12 flex items-center justify-center hover:bg-opacity-80 transition-all duration-300"
    id="next" aria-label="Slide selanjutnya">&gt;</div>

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

        // Initialize first slide
        showSlide(current);

        // Next button
        document.getElementById('next').addEventListener('click', function() {
            current = (current + 1) % total;
            showSlide(current);
        });

        // Previous button
        document.getElementById('prev').addEventListener('click', function() {
            current = (current - 1 + total) % total;
            showSlide(current);
        });

        // Auto-slide every 8 seconds
        let autoSlideInterval = setInterval(() => {
            current = (current + 1) % total;
            showSlide(current);
        }, 8000);

        // Pause auto-slide on hover
        const carousel = document.getElementById('carouselExample');
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });

        carousel.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(() => {
                current = (current + 1) % total;
                showSlide(current);
            }, 8000);
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                current = (current - 1 + total) % total;
                showSlide(current);
            } else if (e.key === 'ArrowRight') {
                current = (current + 1) % total;
                showSlide(current);
            }
        });

        // Pop-up logic
        const promoPopup = document.getElementById('promoPopup');
        const closePopup = document.getElementById('closePopup');

        // Show pop-up immediately
        promoPopup.classList.remove('hidden');

        // Close pop-up
        closePopup.addEventListener('click', () => {
            promoPopup.classList.add('hidden');
        });

        // Close pop-up when clicking outside
        promoPopup.addEventListener('click', (e) => {
            if (e.target === promoPopup) {
                promoPopup.classList.add('hidden');
            }
        });
    });
</script>
