<div class="container mx-auto text-center h-full flex flex-col justify-center">
    <h2 class="text-2xl font-bold mt-8 mb-6 lg:mb-12 pt-10 text-gray-900">Testimoni Pelanggan</h2>
    <p class="text-sm md:text-xl mb-6 mx-4 lg:mx-0 text-gray-700">
        Lihat apa yang pelanggan kami katakan tentang layanan kami. Kami berkomitmen untuk memberikan pelayanan terbaik
        untuk Anda.
    </p>
    
    <!-- Testimonials Swiper -->
    <div class="swiper-container w-full mb-4">
        <div class="swiper-wrapper">
            @foreach ($ulasans as $ulasan)
                <article class="swiper-slide h-[350px] md:h-[400px] lg:h-[420px]" itemscope itemtype="https://schema.org/Review">
                    <div class="flex flex-col justify-between h-full py-12 p-6 lg:p-12 bg-white rounded-lg shadow-lg lg:text-xl"
                        aria-labelledby="testimonial-{{ $loop->index }}">
                        <div class="testimoni-content">
                            <!-- Star Rating -->
                            <div class="flex justify-center mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $ulasan->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 15.27L16.18 19l-1.64-7.03L20 8.24l-7.19-.61L10 1 7.19 7.63 0 8.24l5.46 3.73L3.82 19z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                            <!-- Testimonial Text -->
                            <p class="text-lg lg:text-2xl italic mb-4 text-gray-800" itemprop="reviewBody">"{{ $ulasan->ulasan }}"</p>
                        </div>
                        <div class="testimoni-author">
                            <div class="flex items-center justify-center">
                                <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr($ulasan->nama, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900 text-lg" itemprop="author">{{ $ulasan->nama }}</p>
                                    <p class="text-gray-600">Pelanggan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination mt-4"></div>
    </div>
    
    <!-- Call to Action -->

</div>

<script>
    // Wait for Swiper to be available
    function initSwiper() {
        if (typeof Swiper !== 'undefined') {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                lazy: true,
                slidesPerView: 1,
                initialSlide: 0,
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
            console.log('Swiper initialized successfully');
        } else {
            console.log('Swiper not loaded yet, retrying...');
            setTimeout(initSwiper, 100);
        }
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initSwiper();
    });

    // Also try to initialize when window loads (in case Swiper loads after DOM)
    window.addEventListener('load', function() {
        if (typeof Swiper === 'undefined') {
            initSwiper();
        }
    });
</script>
