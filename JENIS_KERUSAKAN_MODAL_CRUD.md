# Jenis Kerusakan - Modal CRUD Interface

## Deskripsi
Halaman jenis kerusakan telah diperbarui dengan menggunakan modal untuk operasi CRUD (Create, Read, Update, Delete) yang lebih modern dan user-friendly.

## Perubahan yang Dilakukan

### 1. View Updates
- **File**: `resources/views/admin/jenis_kerusakan/index.blade.php`
- **Perubahan**:
  - Menghapus link ke halaman create dan edit terpisah
  - Menambahkan modal untuk Create dan Edit
  - Menggunakan JavaScript untuk interaksi modal
  - Menambahkan pagination
  - Responsive design untuk mobile dan desktop

### 2. Controller Updates
- **File**: `app/Http/Controllers/JenisKerusakanController.php`
- **Perubahan**:
  - Menambahkan pagination (10 item per halaman)
  - Memperbaiki validasi untuk field `biaya_estimasi`
  - Menambahkan unique validation untuk nama jenis kerusakan
  - Menghapus method `create()` dan `edit()` yang tidak diperlukan lagi

### 3. Model Updates
- **File**: `app/Models/JenisKerusakan.php`
- **Perubahan**:
  - Mengubah `estimasi_harga` menjadi `biaya_estimasi` di `$fillable`

### 4. Database Migration
- **File**: `database/migrations/2025_06_28_174423_rename_estimasi_harga_to_biaya_estimasi_in_jenis_kerusakans_table.php`
- **Perubahan**: Mengubah nama kolom dari `estimasi_harga` ke `biaya_estimasi`

### 5. Route Updates
- **File**: `routes/web.php`
- **Perubahan**:
  - Mengubah route dari `jenis_kerusakan` ke `admin/jenis_kerusakan`
  - Menambahkan proper route naming untuk admin prefix

### 6. File Cleanup
- Menghapus `resources/views/admin/jenis_kerusakan/create.blade.php`
- Menghapus `resources/views/admin/jenis_kerusakan/edit.blade.php`

## Fitur Modal

### Create Modal
- Form untuk menambah jenis kerusakan baru
- Field: Nama (required), Estimasi Biaya (optional)
- Validasi real-time
- Tombol Batal dan Simpan

### Edit Modal
- Form untuk mengedit jenis kerusakan
- Pre-filled dengan data yang ada
- Field: Nama (required), Estimasi Biaya (optional)
- Tombol Batal dan Update

### Delete Confirmation
- Menggunakan SweetAlert2 untuk konfirmasi
- Pesan warning sebelum menghapus
- Tombol konfirmasi dan batal

## Interaksi Modal

### JavaScript Functions
- `openCreateModal()`: Membuka modal create
- `closeCreateModal()`: Menutup modal create
- `openEditModal(id, nama, biayaEstimasi)`: Membuka modal edit dengan data
- `closeEditModal()`: Menutup modal edit
- `confirmDeleteJenisKerusakan(id)`: Konfirmasi hapus

### Modal Controls
- Klik di luar modal untuk menutup
- Tekan Escape untuk menutup
- Tombol Batal untuk menutup modal

## Responsive Design

### Desktop View
- Tabel dengan kolom: No, Nama, Estimasi Biaya, Aksi
- Icon untuk edit dan delete
- Pagination di bawah tabel

### Mobile View
- Card layout untuk setiap jenis kerusakan
- Tombol Edit dan Hapus yang lebih besar
- Informasi yang mudah dibaca

## Validasi

### Server-side Validation
- Nama: required, string, max 255, unique
- Biaya Estimasi: nullable, numeric, min 0

### Client-side Features
- Required field indicators (*)
- Placeholder text untuk panduan
- Error messages yang jelas

## Troubleshooting

### PUT Method Not Supported Error
**Masalah**: "The PUT method is not supported for route admin/jenis_kerusakan/4"

**Solusi**:
1. Pastikan route terdaftar dengan benar:
   ```bash
   php artisan route:list | grep jenis_kerusakan
   ```

2. Clear route cache:
   ```bash
   php artisan route:clear
   ```

3. Pastikan form menggunakan method spoofing Laravel:
   ```html
   @method('PUT')
   ```

4. Pastikan CSRF token tersedia di layout:
   ```html
   <meta name="csrf-token" content="{{ csrf_token() }}">
   ```

### Route Configuration
Route yang benar untuk jenis kerusakan:
```php
Route::resource('admin/jenis_kerusakan', JenisKerusakanController::class)->names([
    'index' => 'jenis_kerusakan.index',
    'create' => 'jenis_kerusakan.create',
    'store' => 'jenis_kerusakan.store',
    'show' => 'jenis_kerusakan.show',
    'edit' => 'jenis_kerusakan.edit',
    'update' => 'jenis_kerusakan.update',
    'destroy' => 'jenis_kerusakan.destroy',
]);
```

## Keuntungan

1. **UX yang Lebih Baik**: Tidak perlu pindah halaman untuk CRUD
2. **Responsive**: Bekerja dengan baik di mobile dan desktop
3. **Modern**: Interface yang clean dan modern
4. **Efisien**: Lebih cepat untuk operasi CRUD
5. **Konsisten**: Menggunakan modal yang sama untuk create dan edit

## Catatan Teknis

- Modal menggunakan z-index 50 untuk memastikan tampil di atas konten lain
- Body overflow di-disable saat modal terbuka
- Form menggunakan method POST untuk create dan PUT untuk update
- CSRF token otomatis disertakan di semua form
- SweetAlert2 digunakan untuk konfirmasi delete
- Laravel method spoofing digunakan untuk PUT request 