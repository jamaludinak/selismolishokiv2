<div class="container py-16 mx-auto text-center h-full flex flex-col justify-center">
    <h2 class="text-2xl font-bold mt-8 mb-6 lg:mb-12 pt-10 text-gray-900">Testimoni Pelanggan</h2>
    <p class="text-sm md:text-xl mb-6 mx-4 lg:mx-0 text-gray-700">
        Lihat apa yang pelanggan kami katakan tentang layanan kami. Kami berkomitmen untuk memberikan pelayanan terbaik
        untuk Anda.
    </p>
    <div class="swiper-container w-full mb-4">
        <div class="swiper-wrapper">
            @foreach ($ulasans as $ulasan)
                <article class="swiper-slide py-12 p-6 lg:p-12 bg-white rounded-lg shadow-lg lg:text-xl"
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
                        <p class="text-sm lg:text-lg text-gray-500" id="testimonial-{{ $loop->index }}">-
                            {{ $ulasan->nama }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="swiper-pagination mt-4"></div>
    </div>
</div>
