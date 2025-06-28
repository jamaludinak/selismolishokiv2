# Struktur Routes & Hak Akses - Dokumentasi

## 🎯 Struktur Routes yang Diperbaiki

### **Routes untuk Semua Role (admin, teknisi, owner)**
```php
Route::middleware(['auth', 'role:admin,teknisi,owner'])->group(function () {
    // Dashboard - Semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Settings - Semua role bisa akses
    Route::resource('settings', SettingController::class);
});
```

### **Routes untuk Admin & Owner**
```php
Route::middleware(['role:admin,owner'])->group(function () {
    // Reservasi
    Route::resource('admin/reservasi', ReservasiController::class);
    Route::post('/admin/reservasi/updateStatus/{id}', [ReservasiController::class, 'updateStatus']);
    Route::get('/admin/historireservasi', [ReservasiController::class, 'history']);
    
    // Jenis Kerusakan
    Route::resource('jenis_kerusakan', JenisKerusakanController::class);
    
    // Jadwal
    Route::resource('jadwal', JadwalController::class);
    
    // Data Pelanggan
    Route::resource('pelanggan', DataPelangganController::class);
    
    // Ulasan
    Route::resource('ulasan', UlasanController::class);
    
    // Riwayat
    Route::resource('riwayat', RiwayatController::class);

    // Klaim Garansi
    Route::prefix('admin/klaim-garansi')->name('admin.klaim-garansi.')->group(function () {
        Route::get('/', [AdminKlaimGaransiController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminKlaimGaransiController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [AdminKlaimGaransiController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [AdminKlaimGaransiController::class, 'reject'])->name('reject');
        Route::put('/{id}/status', [AdminKlaimGaransiController::class, 'updateStatus'])->name('updateStatus');
    });
});
```

### **Routes untuk Owner Saja**
```php
Route::middleware(['role:owner'])->group(function () {
    // Data Pegawai - Hanya Owner yang bisa akses
    Route::resource('pegawai', PegawaiController::class);
});
```

### **Routes untuk Owner & Teknisi**
```php
Route::middleware(['role:owner,teknisi'])->group(function () {
    // Panel Teknisi
    Route::prefix('admin/teknisi')->name('admin.teknisi.')->group(function () {
        Route::get('/', [TeknisiController::class, 'index'])->name('index');
        Route::put('/{id}/status', [TeknisiController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/{id}/detail', [TeknisiController::class, 'getReservasiDetail'])->name('detail');
    });
});
```

## 🔧 Masalah yang Diperbaiki

### **Sebelumnya:**
- ❌ Route `admin/reservasi` didefinisikan dua kali (untuk owner dan admin)
- ❌ Konflik route menyebabkan error "Anda tidak memiliki izin"
- ❌ Struktur routes tidak terorganisir dengan baik

### **Sekarang:**
- ✅ Tidak ada duplikasi route
- ✅ Struktur routes terorganisir berdasarkan role
- ✅ Owner bisa akses semua fitur
- ✅ Admin bisa akses fitur admin (kecuali Data Pegawai)
- ✅ Teknisi hanya bisa akses Panel Teknisi dan Pengaturan

## 🎨 Hak Akses Berdasarkan Role

### **Owner (role_id = 3)**
- ✅ Dashboard
- ✅ Semua menu admin (Reservasi, History, Jenis Kerusakan, Jadwal, Data Pelanggan, Ulasan, Klaim Garansi)
- ✅ Data Pegawai (khusus Owner)
- ✅ Panel Teknisi
- ✅ Pengaturan

### **Admin (role_id = 1)**
- ✅ Dashboard
- ✅ Daftar Reservasi
- ✅ History Reservasi
- ✅ Jenis Kerusakan
- ✅ Jadwal
- ✅ Data Pelanggan
- ✅ Ulasan
- ✅ Klaim Garansi
- ✅ Pengaturan
- ❌ Data Pegawai (khusus Owner)
- ❌ Panel Teknisi (khusus Owner & Teknisi)

### **Teknisi (role_id = 2)**
- ✅ Dashboard
- ✅ Panel Teknisi
- ✅ Pengaturan
- ❌ Semua menu admin lainnya

## 🚀 Cara Test

1. **Login sebagai Owner** (role_id = 3)
   - Seharusnya bisa akses semua menu

2. **Login sebagai Admin** (role_id = 1)
   - Seharusnya bisa akses menu admin (kecuali Data Pegawai)

3. **Login sebagai Teknisi** (role_id = 2)
   - Seharusnya hanya bisa akses Dashboard, Panel Teknisi, dan Pengaturan

## 📝 Catatan Penting

1. **Role ID Mapping:**
   - 1 = Admin
   - 2 = Teknisi
   - 3 = Owner

2. **Tidak ada lagi duplikasi route** yang menyebabkan konflik

3. **Middleware CheckRole** bekerja dengan benar menggunakan `role_id`

4. **Semua cache sudah di-clear** untuk memastikan perubahan terdaftar

5. **Debugging code sudah dihapus** dari middleware

Sekarang sistem hak akses sudah berfungsi dengan benar dan tidak ada lagi error "Anda tidak memiliki izin untuk membuka halaman ini" untuk user yang memiliki role yang sesuai. 