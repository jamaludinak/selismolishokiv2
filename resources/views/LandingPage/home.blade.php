@extends('LandingPage.layouts.app')

@section('title', 'Selis Molis Hoki - Bengkel Sepeda Listrik Terpercaya di Purwokerto')
@section('description', 'Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto. Layanan home service dan bengkel dengan teknisi profesional. Perbaikan cepat, berkualitas, dan terpercaya.')
@section('keywords', 'bengkel sepeda listrik, motor listrik, home service, purwokerto, perbaikan sepeda listrik, teknisi profesional, bengkel terpercaya, servis sepeda listrik')

@section('og_title', 'Selis Molis Hoki - Bengkel Sepeda Listrik Terpercaya di Purwokerto')
@section('og_description', 'Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto. Layanan home service dan bengkel dengan teknisi profesional.')
@section('og_image', asset('images/logofix1.jpg'))

@section('twitter_title', 'Selis Molis Hoki - Bengkel Sepeda Listrik Terpercaya')
@section('twitter_description', 'Bengkel spesialis sepeda listrik dan motor listrik di Purwokerto. Layanan home service dan bengkel dengan teknisi profesional.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section relative w-full h-screen pt-10" style="z-index: 0;">
        @include('LandingPage.component.hero')
    </section>

    <!-- Portfolio Section -->
    <section id="portofolio" class="mt-8 md:mt-16" aria-label="Portfolio Layanan">
        @include('LandingPage.component.porto')
    </section>

    <!-- Services Section -->
    <section id="services" style="background-color: #f8f8f8" class="mb-8" aria-label="Layanan Bengkel">
        @include('LandingPage.component.service')
    </section>

    <!-- Status Check Section -->
    <section id="cek-status" style="background-color: white" aria-label="Cek Status Servis">
        @include('LandingPage.component.status')
    </section>

    <!-- Testimonials Section -->
    <section id="testimoni" class="bg-gray-50 text-gray-900 overflow-hidden" aria-label="Testimoni Pelanggan">
        @include('LandingPage.component.testi')
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="bg-gray-50 text-gray-900" aria-label="Pertanyaan Umum">
        @include('LandingPage.component.faq')
    </section>

    <!-- About Us Section -->
    <section id="aboutus" style="background-color: #F3F4F6" class="bg-gray-100 text-gray-900" aria-label="Tentang Kami">
        @include('LandingPage.component.about')
    </section>

    <!-- Contact Section -->
    <section id="contact" style="background-color: #f5f5f5" class="text-gray-900" aria-label="Kontak Kami">
        @include('LandingPage.component.contact')
    </section>

    <!-- Additional SEO Content -->
    <section class="py-8 bg-white" aria-label="Informasi Tambahan">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Bengkel Sepeda Listrik Terpercaya di Purwokerto</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Layanan Profesional</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Selis Molis Hoki adalah bengkel spesialis sepeda listrik dan motor listrik terpercaya di Purwokerto. 
                            Kami menyediakan layanan perbaikan yang cepat, berkualitas, dan profesional dengan teknisi berpengalaman.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Home Service & Bengkel</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Nikmati kenyamanan layanan home service atau kunjungi bengkel kami. 
                            Kami siap melayani perbaikan sepeda listrik dan motor listrik dengan standar kualitas terbaik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
