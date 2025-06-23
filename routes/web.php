<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthPelangganController;

Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!file_exists($path)) abort(404);
    return response()->file($path);
});

// ========================================================
// ✅ PUBLIC ROUTES (TIDAK PERLU LOGIN)
// ========================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', fn() => view('users.aboutus'))->name('aboutus');
Route::get('/contact', fn() => view('users.contact'))->name('contact');

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

// User Auth
Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login']);
Route::get('/user/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register');
Route::post('/user/register', [UserAuthController::class, 'register']);
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

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

// Rute untuk login pelanggan
Route::get('/login-pelanggan', [AuthPelangganController::class, 'showLoginForm'])->name('login.pelanggan');
Route::post('/login-pelanggan', [AuthPelangganController::class, 'login']);
// Rute untuk registrasi pelanggan
Route::get('/register-pelanggan', [AuthPelangganController::class, 'showRegisterForm'])->name('register.pelanggan');
Route::post('/register-pelanggan', [AuthPelangganController::class, 'register']);
// Rute untuk logout pelanggan
Route::post('/logout-pelanggan', [AuthPelangganController::class, 'logout'])->name('logout.pelanggan');

// Dashboard pelanggan
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/dashboard-pelanggan', function () {
        return view('pelanggan.dashboard');
    })->name('dashboard.pelanggan');
});

