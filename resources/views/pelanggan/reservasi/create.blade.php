@extends('pelanggan.layouts.app')
@section('title', 'Buat Reservasi')
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white rounded-lg shadow p-6">
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
            });

            tabGarage.addEventListener('click', () => {
                tabGarage.classList.replace('bg-orange-100', 'bg-orange-500');
                tabGarage.classList.replace('text-black', 'text-white');
                tabHome.classList.replace('bg-orange-500', 'bg-orange-100');
                tabHome.classList.replace('text-white', 'text-black');
                formGarage.classList.remove('hidden');
                formHome.classList.add('hidden');
            });
        });
    </script>
@endpush
