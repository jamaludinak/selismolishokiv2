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
use App\Http\Controllers\ProfilePelangganController;
use App\Http\Controllers\ReservasiPelangganController;
use App\Http\Controllers\RiwayatServisPelangganController;
use App\Http\Controllers\KlaimGaransiController;
use App\Http\Controllers\DashboardPelangganController;
use App\Http\Controllers\Admin\KlaimGaransiController as AdminKlaimGaransiController;
use App\Http\Controllers\Admin\TeknisiController;
use App\Http\Controllers\SettingController;

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
Route::get('/aboutus', fn() => view('LandingPage.aboutus'))->name('aboutus');
Route::get('/contact', fn() => view('LandingPage.contact'))->name('contact');

Route::get('/servis', [PelangganController::class, 'create'])->name('services.servis');
Route::post('/servis/submit', [PelangganController::class, 'store'])->name('services.submit');
Route::post('/hitung-biaya-perjalanan', [PelangganController::class, 'hitungBiayaPerjalanan'])->name('services.hitungBiayaPerjalanan');
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
// ✅ ADMIN & TEKNISI ROUTES (auth:web, role:admin|teknisi|owner)
// ========================================================
Route::middleware(['auth', 'role:admin,teknisi,owner'])->group(function () {
    // Dashboard - Semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings - Semua role bisa akses
    Route::resource('settings', SettingController::class);

    // ========================================================
    // ✅ ADMIN & OWNER ROUTES (Reservasi, History, Jenis Kerusakan, Jadwal, Data Pelanggan, Ulasan, Klaim Garansi)
    // ========================================================
    Route::middleware(['role:admin,owner'])->group(function () {
        // Reservasi
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

        // Jenis Kerusakan
        Route::resource('admin/jenis_kerusakan', JenisKerusakanController::class)->names([
            'index' => 'jenis_kerusakan.index',
            'create' => 'jenis_kerusakan.create',
            'store' => 'jenis_kerusakan.store',
            'show' => 'jenis_kerusakan.show',
            'edit' => 'jenis_kerusakan.edit',
            'update' => 'jenis_kerusakan.update',
            'destroy' => 'jenis_kerusakan.destroy',
        ]);
        
        // Jadwal
        Route::resource('jadwal', JadwalController::class);
        
        // Data Pelanggan
        Route::resource('pelanggan', DataPelangganController::class);
        
        // Ulasan
        Route::resource('ulasan', UlasanController::class);
        
        // Riwayat
        Route::resource('riwayat', RiwayatController::class);

        // Admin Klaim Garansi Routes
        Route::prefix('admin/klaim-garansi')->name('admin.klaim-garansi.')->group(function () {
            Route::get('/', [AdminKlaimGaransiController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminKlaimGaransiController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [AdminKlaimGaransiController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [AdminKlaimGaransiController::class, 'reject'])->name('reject');
            Route::put('/{id}/status', [AdminKlaimGaransiController::class, 'updateStatus'])->name('updateStatus');
        });
    });

    // ========================================================
    // ✅ OWNER ONLY ROUTES (Data Pegawai)
    // ========================================================
    Route::middleware(['role:owner'])->group(function () {
        Route::resource('pegawai', PegawaiController::class);
    });

    // ========================================================
    // ✅ OWNER & TEKNISI ROUTES (Panel Teknisi)
    // ========================================================
    Route::middleware(['role:owner,teknisi'])->group(function () {
        // Admin Teknisi Routes
        Route::prefix('admin/teknisi')->name('admin.teknisi.')->group(function () {
            Route::get('/', [TeknisiController::class, 'index'])->name('index');
            Route::put('/{id}/status', [TeknisiController::class, 'updateStatus'])->name('updateStatus');
            Route::get('/{id}/detail', [TeknisiController::class, 'getReservasiDetail'])->name('detail');
        });
    });
});

// ========================================================
// ✅ PELANGGAN ROUTES (auth:pelanggan)
// ========================================================
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/dashboard-pelanggan', [DashboardPelangganController::class, 'index'])->name('dashboard.pelanggan');
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('alamat', AlamatPelangganController::class);
    Route::post('/alamat/jadikan-utama/{id}', [AlamatPelangganController::class, 'jadikanUtama'])->name('alamat.utama');
    Route::resource('reservasi', ReservasiPelangganController::class);
    // Add specific routes for home service and garage service
    Route::post('/reservasi/home-service', [ReservasiPelangganController::class, 'store'])->name('reservasi.store.home');
    Route::post('/reservasi/garage-service', [ReservasiPelangganController::class, 'storeGarage'])->name('reservasi.store.garage');
    Route::resource('profile', ProfilePelangganController::class);
    Route::resource('riwayats', RiwayatServisPelangganController::class)->only(['index', 'show']);
    Route::resource('klaim-garansi', KlaimGaransiController::class)->only(['index', 'store']);
    Route::get('/klaim-garansi/create/resi/{noResi}', [KlaimGaransiController::class, 'create'])->name('klaim-garansi.create');
});

// ========================================================
// ✅ FALLBACK UNTUK 404
// ========================================================
Route::fallback(function () {
    return response()->view('error.404', [], 404);
});
