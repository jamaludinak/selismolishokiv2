# Fitur Penugasan Teknisi pada Reservasi

## Deskripsi
Fitur ini memungkinkan sistem untuk mencatat teknisi yang menangani setiap reservasi secara otomatis. Field `id_user` akan diisi otomatis saat status reservasi diubah menjadi 'process' atau 'completed'.

## Perubahan yang Dilakukan

### 1. Database Migration
- **File**: `database/migrations/2025_06_28_172816_add_id_user_to_reservasis_table.php`
- **Perubahan**: Menambahkan kolom `id_user` (nullable) ke tabel `reservasis`
- **Foreign Key**: `id_user` → `users.id` dengan `onDelete('set null')`

### 2. Model Reservasi
- **File**: `app/Models/Reservasi.php`
- **Perubahan**:
  - Menambahkan `id_user` ke `$fillable`
  - Menambahkan relasi `teknisi()` yang mengarah ke model `User`

### 3. Controller Reservasi
- **File**: `app/Http/Controllers/ReservasiController.php`
- **Perubahan**:
  - Method `updateStatus()`: Otomatis mengisi `id_user` dengan user yang sedang login saat status diubah ke 'process' atau 'completed'
  - Method `index()`, `history()`, `show()`: Menambahkan relasi `teknisi` ke query

### 4. View Updates
- **File**: `resources/views/admin/reservasi/index.blade.php`
  - Menambahkan kolom "Teknisi" di tabel desktop
  - Menambahkan informasi teknisi di card mobile
- **File**: `resources/views/admin/reservasi/done.blade.php`
  - Menambahkan kolom "Teknisi" di tabel history
  - Menambahkan informasi teknisi di card mobile history
- **File**: `resources/views/admin/reservasi/show.blade.php`
  - Menambahkan informasi teknisi di halaman detail

## Cara Kerja

1. **Saat Status Diubah ke 'Process'**:
   - Sistem otomatis mengisi `id_user` dengan ID user yang sedang login
   - Teknisi yang mengubah status menjadi 'process' akan tercatat sebagai penanggung jawab

2. **Saat Status Diubah ke 'Completed'**:
   - Sistem otomatis mengisi `id_user` dengan ID user yang sedang login
   - Teknisi yang menyelesaikan reservasi akan tercatat sebagai penanggung jawab

3. **Tampilan Informasi**:
   - Di semua halaman reservasi, informasi teknisi akan ditampilkan
   - Jika belum ada teknisi yang ditugaskan, akan menampilkan "Belum ditugaskan" atau "Tidak ada data"

## Status yang Memicu Penugasan Otomatis
- `process`: Saat reservasi mulai diproses
- `completed`: Saat reservasi selesai

## Status yang Tidak Memicu Penugasan
- `pending`: Status awal reservasi
- `confirmed`: Saat reservasi dikonfirmasi
- `cancelled`: Saat reservasi dibatalkan

## Keuntungan
1. **Akuntabilitas**: Setiap reservasi memiliki teknisi yang bertanggung jawab
2. **Pelacakan**: Admin dapat melihat siapa yang menangani setiap reservasi
3. **Evaluasi**: Data dapat digunakan untuk evaluasi kinerja teknisi
4. **Otomatis**: Tidak perlu input manual, sistem mencatat otomatis

## Catatan Teknis
- Field `id_user` bersifat nullable, sehingga reservasi lama yang tidak memiliki teknisi tidak akan error
- Relasi menggunakan `belongsTo` dari Reservasi ke User
- Foreign key constraint dengan `onDelete('set null')` untuk menjaga integritas data 