@extends('pelanggan.layouts.app')
@section('title', 'Buat Reservasi')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-wrench mr-3 text-4xl"></i>
                            Reservasi Servis
                        </h1>
                        <p class="text-orange-100 mt-2">Pilih jenis layanan servis sepeda listrik Anda</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('riwayats.index') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-cogs mr-2"></i>
                        Formulir Reservasi Servis
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="flex justify-center mb-6">
                        <button id="tab-home" class="tab-button bg-orange-500 text-white px-4 py-2 rounded-l-md">Home
                            Service</button>
                        <button id="tab-garage" class="tab-button bg-orange-100 text-black px-4 py-2 rounded-r-md">Garage
                            Service</button>
                    </div>

            <div id="form-home" class="tab-content">
                @include('pelanggan.reservasi.home-service')
            </div>

            <div id="form-garage" class="tab-content hidden">
                @include('pelanggan.reservasi.garage-service')
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabHome = document.getElementById('tab-home');
            const tabGarage = document.getElementById('tab-garage');
            const formHome = document.getElementById('form-home');
            const formGarage = document.getElementById('form-garage');

            tabHome.addEventListener('click', () => {
                tabHome.classList.replace('bg-orange-100', 'bg-orange-500');
                tabHome.classList.replace('text-black', 'text-white');
                tabGarage.classList.replace('bg-orange-500', 'bg-orange-100');
                tabGarage.classList.replace('text-white', 'text-black');
                formHome.classList.remove('hidden');
                formGarage.classList.add('hidden');
                
                // Trigger estimasi check for home service when tab becomes active
                setTimeout(() => {
                    const homeSelect = document.getElementById('home_damage_type');
                    if (homeSelect && homeSelect.value) {
                        homeSelect.dispatchEvent(new Event('change'));
                    }
                }, 100);
            });

            tabGarage.addEventListener('click', () => {
                tabGarage.classList.replace('bg-orange-100', 'bg-orange-500');
                tabGarage.classList.replace('text-black', 'text-white');
                tabHome.classList.replace('bg-orange-500', 'bg-orange-100');
                tabHome.classList.replace('text-white', 'text-black');
                formGarage.classList.remove('hidden');
                formHome.classList.add('hidden');
                
                // Trigger estimasi check for garage service when tab becomes active
                setTimeout(() => {
                    const garageSelect = document.getElementById('garage_damage_type');
                    if (garageSelect && garageSelect.value) {
                        garageSelect.dispatchEvent(new Event('change'));
                    }
                }, 100);
            });
        });
    </script>
@endpush
