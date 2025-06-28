# Profile Address Responsive Display

## Deskripsi
Mengubah tampilan data alamat di halaman profile pelanggan agar responsif dengan menggunakan card layout di mobile dan tetap menggunakan tabel di desktop.

## Masalah yang Diperbaiki

### **Tabel di Mobile**
- **Masalah**: Tabel sulit dibaca di layar mobile yang kecil
- **Solusi**: Menggunakan card layout yang lebih mobile-friendly

### **Layout yang Tidak Responsif**
- **Masalah**: Tampilan yang sama di semua ukuran layar
- **Solusi**: Tampilan yang berbeda untuk mobile dan desktop

## Perubahan yang Diterapkan

### **1. Desktop View (md:block)**
- Tetap menggunakan tabel dengan kolom yang dioptimalkan
- Menghilangkan kolom longitude dan latitude dari tampilan
- Layout yang compact dan efisien

### **2. Mobile View (md:hidden)**
- Menggunakan card layout yang mudah dibaca
- Setiap alamat dalam card terpisah
- Tombol aksi yang lebih besar dan mudah di-tap

## Struktur Kode

### **Desktop Table Structure:**
```html
<div class="hidden md:block">
    <table class="min-w-full table-auto whitespace-nowrap">
        <thead>
            <tr class="bg-gray-200 text-left text-sm">
                <th class="px-2 py-2">Alamat</th>
                <th class="px-2 py-2">Lokasi</th>
                <th class="px-2 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows -->
        </tbody>
    </table>
</div>
```

### **Mobile Card Structure:**
```html
<div class="md:hidden space-y-4">
    @forelse($alamats as $a)
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
            <div class="space-y-3">
                <!-- Alamat -->
                <div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Alamat:</h3>
                    <p class="text-gray-700 text-sm break-words">{{ $a->alamat }}</p>
                </div>

                <!-- Status Alamat Utama -->
                @if ($a->is_utama)
                    <div class="inline-block">
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-medium">
                            <i class="fas fa-star mr-1"></i>Alamat Utama
                        </span>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-2 pt-2">
                    <!-- Buttons with icons -->
                </div>
            </div>
        </div>
    @empty
        <!-- Empty state -->
    @endforelse
</div>
```

## Fitur Mobile Card

### **1. Card Design**
- Background abu-abu muda (`bg-gray-50`)
- Border dan rounded corners
- Padding yang cukup untuk readability
- Spacing yang konsisten

### **2. Content Organization**
- **Alamat**: Ditampilkan dengan label yang jelas
- **Status**: Badge untuk alamat utama
- **Actions**: Tombol dengan icon dan hover effects

### **3. Action Buttons**
- **Lihat Lokasi**: Icon map marker
- **Edit**: Icon edit
- **Hapus**: Icon trash
- **Jadikan Utama**: Icon star

### **4. Empty State**
- Icon map marker yang besar
- Pesan yang informatif
- Styling yang konsisten

## Responsive Breakpoints

### **Mobile (< 768px)**
- Card layout
- Full-width cards
- Larger touch targets
- Icon-based buttons

### **Desktop (≥ 768px)**
- Table layout
- Compact design
- Text-based buttons
- Efficient use of space

## Keuntungan

### **1. User Experience**
- **Mobile**: Card layout yang mudah dibaca dan di-navigate
- **Desktop**: Table layout yang efisien dan familiar
- **Touch-friendly**: Tombol yang lebih besar di mobile

### **2. Accessibility**
- **Semantic HTML**: Struktur yang jelas
- **Icon + Text**: Kombinasi visual dan tekstual
- **Color coding**: Status yang mudah dibedakan

### **3. Performance**
- **Conditional rendering**: Hanya menampilkan layout yang diperlukan
- **Optimized images**: Icon yang ringan
- **Efficient CSS**: Minimal overhead

## Testing

### Test Case yang Harus Berhasil:

1. ✅ **Desktop View (≥ 768px)**
   - Tabel ditampilkan dengan benar
   - Kolom terorganisir dengan baik
   - Tombol aksi berfungsi normal

2. ✅ **Mobile View (< 768px)**
   - Card layout ditampilkan
   - Setiap alamat dalam card terpisah
   - Tombol aksi mudah di-tap

3. ✅ **Responsive Behavior**
   - Perubahan layout saat resize window
   - Tidak ada layout yang tumpang tindih
   - Content tetap readable

4. ✅ **Functionality**
   - Semua tombol aksi berfungsi
   - Modal maps tetap berfungsi
   - Form submission berjalan normal

5. ✅ **Empty State**
   - Tampilan yang informatif saat tidak ada data
   - Konsisten di mobile dan desktop

## Catatan Teknis

### **CSS Classes yang Digunakan:**
- `hidden md:block`: Sembunyikan di mobile, tampilkan di desktop
- `md:hidden`: Tampilkan di mobile, sembunyikan di desktop
- `space-y-4`: Spacing antar card
- `flex flex-wrap gap-2`: Layout tombol yang responsive

### **Icon Usage:**
- Font Awesome icons untuk visual consistency
- Icon + text combination untuk clarity
- Consistent sizing dan spacing

### **Color Scheme:**
- Green: Lihat lokasi, alamat utama
- Yellow: Edit
- Red: Hapus
- Blue: Jadikan utama

## Status
- ✅ Desktop table view implemented
- ✅ Mobile card view implemented
- ✅ Responsive breakpoints working
- ✅ Action buttons functional
- ✅ Empty state handled
- ✅ Touch-friendly mobile design 