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
use App\Http\Controllers\ReservasiPelangganController;
use App\Http\Controllers\ProfilePelangganController;
use App\Http\Controllers\RiwayatServisPelangganController;
use App\Http\Controllers\KlaimGaransiController;

// Route akses file storage
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
// ✅ AUTHENTICATION ROUTES (ADMIN & PELANGGAN)
// ========================================================
// Login Admin/Teknisi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Login Pelanggan
Route::get('/login-pelanggan', [AuthPelangganController::class, 'showLoginForm'])->name('login.pelanggan');
Route::post('/login-pelanggan', [AuthPelangganController::class, 'login']);
Route::get('/register-pelanggan', [AuthPelangganController::class, 'showRegisterForm'])->name('register.pelanggan');
Route::post('/register-pelanggan', [AuthPelangganController::class, 'register']);
Route::post('/logout-pelanggan', [AuthPelangganController::class, 'logout'])->name('logout.pelanggan');

// ========================================================
// ✅ ADMIN & TEKNISI ROUTES (auth:web, role:admin|teknisi)
// ========================================================
Route::middleware(['auth', 'role:admin,teknisi'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('admin/reservasi', ReservasiController::class)->names([
        'index' => 'admin.reservasi.index',
        'create' => 'admin.reservasi.create',
        'store' => 'admin.reservasi.store',
        'show' => 'admin.reservasi.show',
        'edit' => 'admin.reservasi.edit',
        'update' => 'admin.reservasi.update',
        'destroy' => 'admin.reservasi.destroy',
    ]);

    Route::post('/admin/reservasi/updateStatus/{id}', [ReservasiController::class, 'updateStatus'])->name('admin.reservasi.updateStatus');
    Route::get('/admin/historireservasi', [ReservasiController::class, 'history'])->name('admin.reservasi.history');

    Route::resource('jenis_kerusakan', JenisKerusakanController::class);
    Route::resource('riwayat', RiwayatController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('pelanggan', DataPelangganController::class);
    Route::resource('ulasan', UlasanController::class);
});

// ========================================================
// ✅ PELANGGAN ROUTES (auth:pelanggan)
// ========================================================
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/dashboard-pelanggan', fn() => view('pelanggan.dashboard'))->name('dashboard.pelanggan');
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('alamat', AlamatPelangganController::class);
    Route::resource('reservasi', ReservasiPelangganController::class);
    Route::resource('profile', ProfilePelangganController::class);
    Route::resource('riwayats', RiwayatServisPelangganController::class)->only(['index', 'show']);
    Route::resource('klaim-garansi', KlaimGaransiController::class)->only(['index','store']);
    Route::get('/klaim-garansi/create/resi/{noResi}', [KlaimGaransiController::class, 'create'])->name('klaim-garansi.create');
});

// ========================================================
// ✅ FALLBACK UNTUK 404
// ========================================================
Route::fallback(function () {
    return response()->view('error.404', [], 404);
});
