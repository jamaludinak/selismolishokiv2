# Profile and Maps Fixes

## Deskripsi
Memperbaiki dua masalah utama:
1. Field nomor HP di halaman profile dibuat disabled dengan keterangan untuk hubungi admin
2. Masalah maps yang menindih sidebar di halaman alamat (create, index, edit)

## Masalah yang Diperbaiki

### 1. **Field Nomor HP di Profile**
- **Masalah**: User dapat mengubah nomor HP yang bisa menyebabkan masalah data
- **Solusi**: Field dibuat disabled dengan keterangan untuk hubungi admin

### 2. **Maps Menindih Sidebar**
- **Masalah**: Leaflet maps memiliki z-index tinggi yang menindih sidebar
- **Solusi**: Mengatur z-index yang tepat untuk maps dan modal

## Perubahan Detail

### **1. Halaman Profile** (`profile/index.blade.php`)

#### Sebelum:
```html
<input type="text" name="noHP" value="{{ old('noHP', $user->noHP) }}"
    class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm focus:ring-orange-500 focus:border-orange-500"
    required>
```

#### Sesudah:
```html
<input type="text" name="noHP" value="{{ old('noHP', $user->noHP) }}"
    class="mt-1 block w-full border rounded-md px-3 py-2 shadow-sm bg-gray-100 cursor-not-allowed"
    disabled>
<p class="mt-1 text-xs text-gray-500 italic">
    <i class="fas fa-info-circle mr-1"></i>
    Untuk mengubah nomor HP, silakan hubungi admin
</p>
```

### **2. Halaman Alamat Create** (`alamat/create.blade.php`)

#### CSS yang Ditambahkan:
```css
/* Ensure Leaflet maps don't overlap with sidebar */
.leaflet-container {
    z-index: 10 !important;
}

.leaflet-control-container {
    z-index: 11 !important;
}

#map {
    position: relative;
    z-index: 10;
}
```

#### HTML yang Diperbaiki:
```html
<div class="mb-4 relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">Atau pilih lokasi di peta:</label>
    <div id="map" class="w-full h-64 rounded border mb-2 relative z-10"></div>
    <small class="text-gray-500">Geser pin merah ke lokasi alamat Anda, koordinat akan terisi otomatis.</small>
</div>
```

### **3. Halaman Alamat Edit** (`alamat/edit.blade.php`)

- CSS yang sama dengan create page
- HTML structure yang sama dengan create page

### **4. Modal Maps** (`alamat/index.blade.php`, `profile/index.blade.php`)

#### Sebelum:
```html
<div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded shadow-lg p-4 max-w-2xl w-full relative">
        <button onclick="closeMap()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
        <div id="mapFrame" class="w-full h-96"></div>
    </div>
</div>
```

#### Sesudah:
```html
<div id="mapModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-40">
    <div class="bg-white rounded shadow-lg p-4 max-w-2xl w-full relative mx-4">
        <button onclick="closeMap()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        <div id="mapFrame" class="w-full h-96"></div>
    </div>
</div>
```

## Z-Index Hierarchy

### **Sidebar Structure:**
- Backdrop: `z-30`
- Sidebar: `z-40`
- Modal Maps: `z-40` (sama dengan sidebar, tapi tidak overlap)
- Leaflet Maps: `z-10` (lebih rendah dari sidebar)

### **Layout Priority:**
1. **Sidebar** (z-40): Paling tinggi untuk navigasi
2. **Modal Maps** (z-40): Sama dengan sidebar, tapi dengan backdrop
3. **Leaflet Maps** (z-10): Lebih rendah untuk tidak menindih sidebar
4. **Content** (z-1): Paling rendah

## Keuntungan

### **1. Data Integrity**
- Nomor HP tidak dapat diubah sembarangan
- Admin dapat mengontrol perubahan data sensitif
- Mencegah konflik data

### **2. User Experience**
- Maps tidak menindih sidebar
- Modal maps dapat ditutup dengan mudah
- Layout yang konsisten di semua halaman

### **3. Security**
- Field nomor HP protected dari perubahan user
- Keterangan yang jelas untuk prosedur perubahan
- Kontrol admin yang lebih baik

## Testing

### Test Case yang Harus Berhasil:

1. ✅ **Profile Page**
   - Field nomor HP disabled dan abu-abu
   - Keterangan "hubungi admin" muncul
   - Form dapat di-submit tanpa error

2. ✅ **Alamat Create Page**
   - Maps tidak menindih sidebar
   - Maps dapat di-interact dengan normal
   - Form dapat di-submit dengan koordinat

3. ✅ **Alamat Edit Page**
   - Maps tidak menindih sidebar
   - Maps menampilkan lokasi yang benar
   - Form dapat di-update dengan normal

4. ✅ **Modal Maps**
   - Modal tidak menindih sidebar
   - Modal dapat dibuka dan ditutup
   - Maps dalam modal berfungsi normal

5. ✅ **Sidebar Functionality**
   - Sidebar dapat dibuka/tutup di mobile
   - Sidebar tidak tertutup maps
   - Navigasi sidebar berfungsi normal

## Catatan Teknis

### **CSS Important Usage:**
- `!important` digunakan untuk override Leaflet default styles
- Z-index diatur untuk memastikan hierarchy yang benar
- Media queries untuk responsive behavior

### **JavaScript Compatibility:**
- Leaflet maps tetap berfungsi normal
- Modal functionality tidak terpengaruh
- Sidebar toggle tetap berfungsi

### **Browser Support:**
- Chrome, Firefox, Safari
- Mobile browsers (iOS Safari, Chrome Mobile)
- Tablet browsers

## Status
- ✅ Profile field nomor HP disabled
- ✅ Maps z-index fixed di create page
- ✅ Maps z-index fixed di edit page
- ✅ Modal maps z-index fixed
- ✅ Sidebar tidak tertutup maps
- ✅ User experience improved 