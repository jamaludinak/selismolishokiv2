<div class="container mx-auto text-center h-full flex flex-col justify-center">
    <h2 class="text-2xl font-bold mt-8 mb-6 lg:mb-12 pt-10 text-gray-900">Testimoni Pelanggan</h2>
    <p class="text-sm md:text-xl mb-6 mx-4 lg:mx-0 text-gray-700">
        Lihat apa yang pelanggan kami katakan tentang layanan kami. Kami berkomitmen untuk memberikan pelayanan terbaik
        untuk Anda.
    </p>
    <div class="swiper-container w-full mb-4">
        <div class="swiper-wrapper">
            @foreach ($ulasans as $ulasan)
                <article class="swiper-slide h-[350px] md:h-[400px] lg:h-[420px]">
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
                            <p class="text-lg lg:text-2xl italic mb-4 text-gray-800">"{{ $ulasan->ulasan }}"</p>
                        </div>
                        <p class="text-sm lg:text-lg text-gray-500 text-center" id="testimonial-{{ $loop->index }}">-
                            {{ $ulasan->nama }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="swiper-pagination mt-4"></div>
    </div>
</div>

@push('js')
    <script>
        // swiper-init.js
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000, // Delay for better readability
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            lazy: true, // Lazy loading enabled
            slidesPerView: 1,
            initialSlide: 0, // Default to first slide
            breakpoints: {
                640: {
                    initialSlide: document.querySelectorAll('.swiper-slide').length -
                        1, // Show last testimonial in mobile view
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endpush
