@extends('users.LandingPage.layouts.app')
@section('title', 'Beranda Utama')
@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen pt-10" style="z-index: 0;">
        @include('users.LandingPage.component.hero')
    </section>

    {{-- portofolio section --}}
    <section id="portofolio" class="mt-8 md:mt-16">
        @include('users.LandingPage.component.porto')
    </section>

    <!-- Services Section -->
    <section id="services" style="background-color: #f8f8f8">
        @include('users.LandingPage.component.service')
    </section>

    {{-- cek status --}}
    <section id="cek-status" style="background-color: white">
        @include('users.LandingPage.component.status')
    </section>

    {{-- testimoni section --}}
    <section id="testimoni" class="bg-gray-50 text-gray-900 overflow-hidden">
        @include('users.LandingPage.component.testi')
    </section>

    {{-- faq section --}}
    <section id="faq" class="bg-gray-50 text-gray-900">
        @include('users.LandingPage.component.faq')
    </section>

    <!-- About Us Section -->
    <section id="aboutus" style="background-color: #F3F4F6" class="bg-gray-100 text-gray-900">
        @include('users.LandingPage.component.about')
    </section>

    <!-- Contact Section -->
    <section id="contact" style="background-color: #f5f5f5" class="text-gray-900">
        @include('users.LandingPage.component.contact')
    </section>
@endsection