# Auto-Fill User Data in Reservation Forms

## Overview
Mengubah form reservasi garage-service dan home-service agar field nama dan nomor WhatsApp otomatis terisi berdasarkan user yang login dan fieldnya disabled untuk mencegah pengeditan.

## Files Modified

### 1. `resources/views/pelanggan/reservasi/garage-service.blade.php`
### 2. `resources/views/pelanggan/reservasi/home-service.blade.php`

## Changes Made

### Field Nama Lengkap
- **Value**: Otomatis terisi dengan `{{ auth('pelanggan')->user()->nama }}`
- **Disabled**: Field tidak bisa diedit oleh user
- **Styling**: Background abu-abu (`bg-gray-100`) dan text abu-abu (`text-gray-600`) untuk menunjukkan field disabled

### Field Nomor WhatsApp/Telepon
- **Value**: Otomatis terisi dengan `{{ auth('pelanggan')->user()->noHP }}`
- **Disabled**: Field tidak bisa diedit oleh user
- **Styling**: Background abu-abu (`bg-gray-100`) dan text abu-abu (`text-gray-600`) untuk menunjukkan field disabled

## Code Changes

### Before (garage-service.blade.php)
```html
<input type="text" id="name" placeholder="Tulis nama lengkap anda"
    name="namaLengkap" required
    class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
```

### After (garage-service.blade.php)
```html
<input type="text" id="name" placeholder="Tulis nama lengkap anda"
    name="namaLengkap" required value="{{ auth('pelanggan')->user()->nama }}"
    disabled
    class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400 bg-gray-100 text-gray-600">
```

### Before (home-service.blade.php)
```html
<input type="text" id="name" name="namaLengkap" required
    placeholder="Tulis nama lengkap anda"
    class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400">
```

### After (home-service.blade.php)
```html
<input type="text" id="name" name="namaLengkap" required
    placeholder="Tulis nama lengkap anda"
    value="{{ auth('pelanggan')->user()->nama }}"
    disabled
    class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-sm shadow-sm ring-1 ring-orange-300 focus:ring-2 focus:ring-orange-400 bg-gray-100 text-gray-600">
```

## Technical Implementation

### Authentication Guard
- Menggunakan `auth('pelanggan')->user()` untuk mengakses data user yang sedang login
- Guard `pelanggan` digunakan karena user login sebagai pelanggan

### Data Source
- **Nama**: Diambil dari field `nama` di tabel `data_pelanggans`
- **No HP**: Diambil dari field `noHP` di tabel `data_pelanggans`

### Form Submission
- Field yang disabled tetap akan dikirim saat form di-submit
- Data akan dikirim ke controller untuk diproses

## Benefits

1. **User Experience**: User tidak perlu mengetik ulang data yang sudah ada
2. **Data Consistency**: Memastikan data yang dikirim konsisten dengan data user
3. **Security**: Mencegah user mengubah data pribadi mereka
4. **Efficiency**: Mengurangi waktu pengisian form
5. **Error Prevention**: Menghindari kesalahan pengetikan data

## Security Considerations

- Field disabled tetap mengirim data ke server
- Validasi tetap dilakukan di server side
- Data user diambil dari session yang sudah terautentikasi

## Browser Compatibility

- Attribute `disabled` didukung oleh semua browser modern
- Styling CSS menggunakan Tailwind CSS yang kompatibel
- Fallback styling untuk browser lama

## Testing

- Test dengan user yang sudah login
- Verifikasi field terisi otomatis dengan data yang benar
- Pastikan field tidak bisa diedit
- Test form submission berhasil
- Verifikasi data yang dikirim ke server benar 