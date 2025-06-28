# Responsive Table to Card Conversion

## Overview
Mengubah semua tabel di folder pelanggan agar menggunakan tampilan card di mobile dan tetap tabel di desktop untuk meningkatkan user experience pada perangkat mobile.

## Files Modified

### 1. `resources/views/pelanggan/reservasi/index.blade.php`
- **Desktop**: Tabel dengan kolom No. Resi, Nama, Jenis Layanan, Tanggal, Waktu, Status, Aksi
- **Mobile**: Card dengan layout vertikal menampilkan semua informasi reservasi
- **Features**: 
  - Status badge dengan warna yang sesuai
  - Tombol Detail dan Hapus dengan icon
  - Empty state dengan icon calendar

### 2. `resources/views/pelanggan/riwayat/index.blade.php`
- **Desktop**: Tabel dengan kolom No. Resi, Kode Kendaraan, Status, Garansi, Berakhir, Aksi
- **Mobile**: Card dengan informasi riwayat servis dan status garansi
- **Features**:
  - Status garansi dengan warna (Aktif/Kadaluarsa)
  - Tombol Klaim Garansi jika memenuhi syarat
  - Empty state dengan icon history

### 3. `resources/views/pelanggan/klaim_garansi/index.blade.php`
- **Desktop**: Tabel dengan kolom No. Resi, Tanggal Klaim, Deskripsi, Bukti, Status, Tanggal Diproses
- **Mobile**: Card dengan detail klaim garansi
- **Features**:
  - Status klaim dengan warna yang sesuai (diajukan/diterima/ditolak)
  - Link bukti dengan icon
  - Empty state dengan icon shield

### 4. `resources/views/pelanggan/kendaraan/index.blade.php`
- **Desktop**: Tabel dengan kolom Merk, Jenis, Tipe, Nomor Rangka, Tahun Pembelian, Aksi
- **Mobile**: Card dengan detail kendaraan
- **Features**:
  - Informasi lengkap kendaraan
  - Tombol Edit dan Hapus dengan icon
  - Empty state dengan icon car

### 5. `resources/views/pelanggan/alamat/index.blade.php`
- **Desktop**: Tabel dengan kolom Alamat, Longitude, Latitude, Lokasi, Aksi
- **Mobile**: Card dengan informasi alamat dan koordinat
- **Features**:
  - Koordinat dalam format yang mudah dibaca
  - Tombol Lihat Lokasi, Edit, Hapus, dan Jadikan Utama
  - Empty state dengan icon map-marker

## Technical Implementation

### CSS Classes Used
- `hidden md:block`: Sembunyikan di mobile, tampilkan di desktop (md+)
- `md:hidden`: Tampilkan di mobile, sembunyikan di desktop (md+)
- `space-y-4`: Spacing vertikal antar card
- `bg-gray-50`: Background card
- `rounded-lg`: Border radius card
- `border border-gray-200`: Border card

### Responsive Breakpoints
- **Mobile**: < 768px (default)
- **Desktop**: ≥ 768px (md breakpoint)

### Card Structure
```html
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
    <div class="space-y-3">
        <!-- Header with key info and status -->
        <div class="flex justify-between items-start">
            <!-- Key information -->
            <!-- Status badge -->
        </div>
        
        <!-- Details section -->
        <div class="space-y-2">
            <!-- Individual detail items -->
        </div>
        
        <!-- Action buttons -->
        <div class="flex flex-wrap gap-2 pt-2">
            <!-- Action buttons with icons -->
        </div>
    </div>
</div>
```

### Empty State Design
- Icon yang relevan dengan konten
- Pesan yang informatif
- Styling yang konsisten

## Benefits

1. **Mobile UX**: Tampilan yang lebih nyaman di layar kecil
2. **Readability**: Informasi yang lebih mudah dibaca di mobile
3. **Touch-friendly**: Tombol yang lebih besar dan mudah disentuh
4. **Consistent Design**: Desain yang konsisten di semua halaman
5. **Progressive Enhancement**: Desktop tetap menggunakan tabel yang optimal

## Browser Support
- Responsive design menggunakan Tailwind CSS
- Kompatibel dengan semua browser modern
- Graceful degradation untuk browser lama

## Testing
- Test di berbagai ukuran layar (320px - 1920px)
- Test di berbagai browser (Chrome, Firefox, Safari, Edge)
- Test di perangkat mobile fisik
- Test dengan data kosong dan data penuh 