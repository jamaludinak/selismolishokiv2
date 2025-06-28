# Password Nullable Fix

## Deskripsi
Memperbaiki error SQLSTATE[HY000]: General error: 1364 Field 'password' doesn't have a default value dengan membuat field password menjadi nullable di tabel data_pelanggans.

## Masalah
Error terjadi karena beberapa controller membuat DataPelanggan tanpa menyediakan nilai untuk field password, padahal field tersebut tidak nullable di database.

## Solusi

### 1. Migration
**File**: `database/migrations/2025_06_28_181019_make_password_nullable_in_data_pelanggans_table.php`

```php
public function up(): void
{
    Schema::table('data_pelanggans', function (Blueprint $table) {
        $table->string('password')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('data_pelanggans', function (Blueprint $table) {
        $table->string('password')->nullable(false)->change();
    });
}
```

### 2. Model DataPelanggan
**File**: `app/Models/DataPelanggan.php`
- Field `password` sudah termasuk dalam `$fillable`
- Model extends `Authenticatable` untuk autentikasi

## Controller yang Terpengaruh

### 1. DataPelangganController
**File**: `app/Http/Controllers/DataPelangganController.php`
- Method `store()`: Membuat DataPelanggan tanpa password
- Method `update()`: Update DataPelanggan tanpa password

### 2. ReservasiController
**File**: `app/Http/Controllers/ReservasiController.php`
- Method `store()`: Membuat DataPelanggan otomatis saat reservasi

### 3. PelangganController
**File**: `app/Http/Controllers/PelangganController.php`
- Method `store()`: Membuat DataPelanggan untuk Home Service
- Method `storeGarage()`: Membuat DataPelanggan untuk Garage Service

### 4. AuthPelangganController
**File**: `app/Http/Controllers/AuthPelangganController.php`
- Method `register()`: Membuat DataPelanggan dengan password (sudah benar)

## Alur Kerja

### 1. Registrasi Pelanggan
- User mendaftar melalui form registrasi
- Password di-hash dan disimpan
- DataPelanggan dibuat dengan password

### 2. Reservasi Tanpa Login
- User membuat reservasi tanpa login
- DataPelanggan dibuat otomatis tanpa password
- Password bisa diisi nanti saat registrasi

### 3. Admin Menambah Pelanggan
- Admin menambah pelanggan manual
- DataPelanggan dibuat tanpa password
- Pelanggan bisa login nanti dengan registrasi

## Keuntungan

1. **Fleksibilitas**: Pelanggan bisa dibuat tanpa password terlebih dahulu
2. **Kompatibilitas**: Tidak mengganggu fitur yang sudah ada
3. **Keamanan**: Password tetap di-hash saat disimpan
4. **User Experience**: Pelanggan bisa registrasi kapan saja

## Catatan Teknis

- Field password tetap nullable untuk mendukung berbagai skenario
- Autentikasi tetap berfungsi normal untuk user yang sudah punya password
- Tidak ada perubahan pada logika bisnis yang ada
- Migration dapat di-rollback jika diperlukan

## Testing

Setelah perubahan ini, test case berikut harus berhasil:

1. ✅ Admin menambah pelanggan baru
2. ✅ User membuat reservasi tanpa login
3. ✅ User registrasi dengan password
4. ✅ User login dengan password
5. ✅ Update data pelanggan tanpa password

## Status
- ✅ Migration berhasil dijalankan
- ✅ Field password sekarang nullable
- ✅ Semua controller dapat membuat DataPelanggan tanpa error 