<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthPelangganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\JenisKerusakanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\AlamatPelangganController;

Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!file_exists($path)) abort(404);
    return response()->file($path);
});

// ========================================================
// ✅ PUBLIC ROUTES (TIDAK PERLU LOGIN)
// ========================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', fn() => view('users.LandingPage.aboutus'))->name('aboutus');
Route::get('/contact', fn() => view('users.LandingPage.contact'))->name('contact');

// Page Service Pelanggan
Route::get('/servis', [PelangganController::class, 'create'])->name('services.servis');
Route::post('/servis/submit', [PelangganController::class, 'store'])->name('services.submit');
Route::get('/servisgarage', [PelangganController::class, 'createGarage'])->name('services.servisGarage');
Route::post('/servisgarage/submit', [PelangganController::class, 'storeGarage'])->name('services.submitGarage');
Route::get('/cek-resi/{noResi}', [PelangganController::class, 'cekResi'])->name('services.cekResi');
Route::get('/upload-video', [PelangganController::class, 'showUploadForm'])->name('video.upload.form');
Route::post('/upload-video', [PelangganController::class, 'upload'])->name('video.upload');
Route::get('/tambah-ulasan', [PelangganController::class, 'formTambahUlasan'])->name('services.formTambahUlasan');
Route::post('/tambah-ulasan/submit', [PelangganController::class, 'tambahUlasan'])->name('services.submitUlasan');

// ========================================================
// ✅ AUTHENTICATION ROUTES
// ========================================================
// Admin/Teknisi Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================================================
// ✅ ADMIN & TEKNISI ROUTES (DENGAN MIDDLEWARE auth & role)
// ========================================================
Route::middleware(['auth', 'role:admin,teknisi'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('reservasi', ReservasiController::class);
    Route::post('/reservasi/updateStatus/{id}', [ReservasiController::class, 'updateStatus'])->name('update.status');
    Route::get('/historireservasi', [ReservasiController::class, 'history'])->name('reservasi.history');

    Route::resource('jenis_kerusakan', JenisKerusakanController::class);
    Route::resource('riwayat', RiwayatController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('pelanggan', DataPelangganController::class);
    Route::resource('ulasan', UlasanController::class);
});

// ========================================================
// ✅ USER ROUTES (DENGAN MIDDLEWARE auth & role:user)
// ========================================================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    // Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // Tambahkan route untuk user lainnya di sini
});

// ========================================================
// ✅ ADMIN PLACEHOLDER (OPSIONAL, BISA DIHAPUS)
// ========================================================
Route::get('admin', fn() => view('admin.index'));

// ========================================================
// ✅ FALLBACK UNTUK 404
// ========================================================
Route::fallback(function () {
    return response()->view('error.404', [], 404);
});

// ========================================================
// ✅ AUTHENTICATION & DASHBOARD ROUTES PELANGGAN
// ========================================================
Route::get('/login-pelanggan', [AuthPelangganController::class, 'showLoginForm'])->name('login.pelanggan');
Route::post('/login-pelanggan', [AuthPelangganController::class, 'login']);
Route::get('/register-pelanggan', [AuthPelangganController::class, 'showRegisterForm'])->name('register.pelanggan');
Route::post('/register-pelanggan', [AuthPelangganController::class, 'register']);
Route::post('/logout-pelanggan', [AuthPelangganController::class, 'logout'])->name('logout.pelanggan');

Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/dashboard-pelanggan', function () {
        return view('pelanggan.dashboard');
    })->name('dashboard.pelanggan');
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('alamat', AlamatPelangganController::class);
    // Tambahkan route fitur pelanggan lain di sini
});

