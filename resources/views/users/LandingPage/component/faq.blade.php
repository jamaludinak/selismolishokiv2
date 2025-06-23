<div class="h-full max-w-6xl px-2 py-2 mx-auto mt-4 mb-4 tracking-wide md:px-4 md:mt-10">
    <!-- Title -->
    <div class="text-2xl font-bold mt-8 mb-4 lg:mb-8 pt-4 text-gray-900 text-center">Frequently Asked
        Questions</div>
    <!-- End Title -->
    <div class="text-lg font-normal mb-2 lg:mb-4 text-gray-900 text-center">Lihat apa yang sering
        pelanggan tanyakan pada kami</div>

    <!-- Grid for FAQs -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column (4 FAQs) -->
        <div class="space-y-3">
            <!-- 1 -->
            <div x-data="accordion(1)" class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Bagaimana cara merawat sepeda listrik
                            agar awet?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600">Merawat sepeda listrik dengan baik dapat
                        memperpanjang masa pakainya. Tips perawatan meliputi pengecekan rutin
                        baterai, tekanan ban, dan pelumas rantai. Pastikan juga untuk mengisi daya
                        baterai secara berkala dan tidak membiarkannya habis total.
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div x-data="accordion(2)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Berapa lama umur baterai sepeda
                            listrik?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600">Umur baterai sepeda listrik bergantung pada
                        jenis dan kualitasnya, biasanya berkisar antara 2 hingga 5 tahun. Faktor
                        lain seperti frekuensi penggunaan, cara pengisian daya, dan kondisi
                        penyimpanan juga memengaruhi masa pakai baterai.</div>
                </div>
            </div>

            <!-- 3 -->
            <div x-data="accordion(3)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Apakah sepeda listrik memerlukan
                            perawatan khusus?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600">Ya, sepeda listrik memerlukan perawatan
                        tambahan seperti pengecekan sistem kelistrikan, terutama baterai dan motor.
                        Selain itu, komponen mekanis seperti rantai, rem, dan ban juga perlu
                        perawatan seperti pada sepeda biasa.</div>
                </div>
            </div>

            <!-- 4 -->
            <div x-data="accordion(4)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Apa saja komponen utama yang harus
                            diganti secara berkala?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600"> Komponen yang perlu diganti secara berkala
                        meliputi baterai, ban, rantai, dan rem. Baterai biasanya perlu diganti
                        setelah beberapa tahun, sementara komponen mekanis seperti rantai dan ban
                        tergantung pada frekuensi penggunaan.</div>
                </div>
            </div>
        </div>
        {{-- Right Column(4Faq) --}}
        <div class="space-y-3">
            <!-- 8 -->
            <div x-data="accordion(8)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Bagaimana cara membersihkan sepeda
                            listrik tanpa merusak komponen elektroniknya?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600">Bersihkan sepeda listrik dengan menggunakan
                        kain lembap dan hindari menyemprotkan air langsung pada komponen elektronik
                        seperti baterai dan motor. Pastikan juga area pengisian daya tetap kering
                        selama pembersihan.</div>
                </div>
            </div>

            <!-- 5 -->
            <div x-data="accordion(5)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Bagaimana cara memilih baterai yang
                            tepat untuk sepeda listrik?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600">Pemilihan baterai yang tepat tergantung
                        pada kapasitas (Wh) dan tegangan (V) yang sesuai dengan sepeda Anda.
                        Sebaiknya konsultasikan dengan teknisi atau baca spesifikasi sepeda listrik
                        Anda sebelum membeli baterai baru.</div>
                </div>
            </div>

            <!-- 6 -->
            <div x-data="accordion(6)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Apakah suku cadang sepeda listrik
                            mudah ditemukan?</span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600"> Sebagian besar suku cadang sepeda listrik
                        seperti baterai, motor, dan komponen mekanis dapat ditemukan di bengkel
                        resmi atau toko suku cadang. Pastikan untuk menggunakan suku cadang asli
                        agar performa sepeda tetap optimal.</div>
                </div>
            </div>

            <!-- 7 -->
            <div x-data="accordion(7)"
                class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide font-bold">Berapa biaya penggantian baterai
                            sepeda listrik?</span>
                        <span :class="handleRotate()"
                            class="transition-transform duration-500 transform fill-current">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div x-ref="tab" :style="handleToggle()"
                    class="relative overflow-hidden transition-all duration-700 max-h-0">
                    <div class="px-6 pb-4 text-gray-600">Biaya penggantian baterai bervariasi
                        tergantung pada jenis dan mereknya. Secara umum, harga baterai berkisar
                        antara Rp 1.000.000 hingga Rp 3.000.000, tergantung kapasitas dan
                        teknologinya.
                    </div>
                </div>
            </div>
        </div>
