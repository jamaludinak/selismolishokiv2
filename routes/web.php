<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});


// ========================================================PELANGGAN========================================================
//home
use App\Http\Controllers\homeController;

Route::get('home', [homeController::class, 'index'])->name('home');
Route::get('/', [homeController::class, 'index'])->name('home');

// about us
Route::get('aboutus', function () {
    return view('aboutus');
})->name('aboutus');

//contact
Route::get('contact', function(){
    return view('contact');
})->name('contact');

// page services

use App\Http\Controllers\PelangganController;

// Route untuk home service
Route::get('/servis', [PelangganController::class, 'create'])->name('services.servis');
Route::post('/servis/submit', [PelangganController::class, 'store'])->name('services.submit');

// Route untuk garage service
Route::get('/servisgarage', [PelangganController::class, 'createGarage'])->name('services.servisGarage');
Route::post('/servisgarage/submit', [PelangganController::class, 'storeGarage'])->name('services.submitGarage');

// Route untuk form cek resi
// Route::get('/cek-resi', [PelangganController::class, 'formCekResi'])->name('services.cekResiForm');
Route::get('/cek-resi/{noResi}', [PelangganController::class, 'cekResi'])->name('services.cekResi');


Route::get('/upload-video', [PelangganController::class, 'showUploadForm'])->name('video.upload.form');

Route::post('/upload-video', [PelangganController::class, 'upload'])->name('video.upload');

// Route untuk form tambah ulasan
Route::get('/tambah-ulasan', [PelangganController::class, 'formTambahUlasan'])->name('services.formTambahUlasan');
Route::post('/tambah-ulasan/submit', [PelangganController::class, 'tambahUlasan'])->name('services.submitUlasan');


// ========================================================ADMIN========================================================
Route::get('admin', function(){
    return view('admin.index');
});



// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// // Rute untuk registrasi
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Rute untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route protected yang hanya bisa diakses setelah login
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('admin');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\JenisKerusakanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\UlasanController;

// ========================================================ADMIN========================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reservasi Routes
    Route::resource('reservasi', ReservasiController::class);
    Route::post('/reservasi/updateStatus/{id}', [ReservasiController::class, 'updateStatus'])->name('update.status');
    Route::get('/historireservasi', [ReservasiController::class, 'history'])->name('reservasi.history');
    
    // Jenis Kerusakan Routes
    Route::resource('jenis_kerusakan', JenisKerusakanController::class);
    
    // Riwayat Routes
    Route::resource('riwayat', RiwayatController::class);
    
    // Jadwal Routes
    Route::resource('jadwal', JadwalController::class);
    
    //Pelanggan
    Route::resource('pelanggan', DataPelangganController::class);
    
    // Ulasan Routes
    Route::resource('ulasan', UlasanController::class);
});


