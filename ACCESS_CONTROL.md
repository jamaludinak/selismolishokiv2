# Sistem Hak Akses - Dokumentasi Lengkap

## 🎯 Ringkasan Hak Akses

### **Owner (role_id = 1)**
- ✅ **Akses Penuh** ke semua fitur sistem
- ✅ Dashboard
- ✅ Semua menu admin
- ✅ Panel teknisi
- ✅ Pengaturan sistem

### **Admin (role_id = 2)**
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

### **Teknisi (role_id = 3)**
- ✅ Dashboard
- ✅ Panel Teknisi
- ✅ Pengaturan
- ❌ Semua menu admin lainnya

## 🔧 Implementasi Teknis

### 1. **Middleware CheckRole**
```php
// app/Http/Middleware/CheckRole.php
public function handle($request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();
    $userRoleId = $user->role_id;

    // Mapping role names ke role_id
    $roleMapping = [
        'admin' => 1,
        'teknisi' => 2,
        'owner' => 3
    ];

    // Convert role names ke role_id untuk pengecekan
    $requiredRoleIds = [];
    foreach ($roles as $role) {
        if (isset($roleMapping[$role])) {
            $requiredRoleIds[] = $roleMapping[$role];
        }
    }

    if (in_array($userRoleId, $requiredRoleIds)) {
        return $next($request);
    }

    return response()->view('error.403', [], 403);
}
```

### 2. **Trait HasRoles**
```php
// app/Traits/HasRoles.php
trait HasRoles
{
    public function hasRole($role): bool
    {
        $roleMapping = [
            'admin' => 1,
            'teknisi' => 2,
            'owner' => 3
        ];

        $roleId = is_numeric($role) ? $role : ($roleMapping[$role] ?? null);
        return $this->role_id === $roleId;
    }

    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    public function isTeknisi(): bool
    {
        return $this->role_id === 2;
    }

    public function isOwner(): bool
    {
        return $this->role_id === 3;
    }
}
```

### 3. **Helper Functions di AppServiceProvider**
```php
// app/Providers/AppServiceProvider.php
Blade::if('role', function ($role) {
    if (!auth()->check()) {
        return false;
    }
    
    $user = auth()->user();
    $roleMapping = [
        'admin' => 1,
        'teknisi' => 2,
        'owner' => 3
    ];
    
    $roleId = is_numeric($role) ? $role : ($roleMapping[$role] ?? null);
    return $user->role_id === $roleId;
});

Blade::if('anyrole', function ($roles) {
    if (!auth()->check()) {
        return false;
    }
    
    $user = auth()->user();
    $roleMapping = [
        'admin' => 1,
        'teknisi' => 2,
        'owner' => 3
    ];
    
    $roles = is_array($roles) ? $roles : [$roles];
    
    foreach ($roles as $role) {
        $roleId = is_numeric($role) ? $role : ($roleMapping[$role] ?? null);
        if ($user->role_id === $roleId) {
            return true;
        }
    }
    
    return false;
});
```

## 🛣️ Routes Configuration

### **Routes untuk Semua Role**
```php
Route::middleware(['auth', 'role:admin,teknisi,owner'])->group(function () {
    // Dashboard - Semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Settings - Semua role bisa akses
    Route::resource('settings', SettingController::class);
});
```

### **Routes untuk Owner (Semua Akses)**
```php
Route::middleware(['role:owner'])->group(function () {
    // Semua routes yang ada sebelumnya
    Route::resource('admin/reservasi', ReservasiController::class);
    Route::resource('jenis_kerusakan', JenisKerusakanController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('pelanggan', DataPelangganController::class);
    Route::resource('ulasan', UlasanController::class);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('admin/klaim-garansi', AdminKlaimGaransiController::class);
    Route::resource('admin/teknisi', TeknisiController::class);
});
```

### **Routes untuk Admin**
```php
Route::middleware(['role:admin'])->group(function () {
    // Reservasi
    Route::resource('admin/reservasi', ReservasiController::class);
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
    Route::resource('admin/klaim-garansi', AdminKlaimGaransiController::class);
});
```

### **Routes untuk Teknisi**
```php
Route::middleware(['role:teknisi'])->group(function () {
    // Panel Teknisi
    Route::resource('admin/teknisi', TeknisiController::class);
});
```

## 🎨 View Implementation

### **Menu Navigation (Layout Admin)**
```blade
{{-- Menu untuk Owner dan Admin --}}
@anyrole(['owner', 'admin'])
<li>
    <a href="{{ route('admin.reservasi.index') }}">Daftar Reservasi</a>
</li>
<li>
    <a href="{{ route('admin.reservasi.history') }}">History Reservasi</a>
</li>
<!-- ... menu lainnya ... -->
@endanyrole

{{-- Menu untuk Owner saja --}}
@role('owner')
<li>
    <a href="{{ route('pegawai.index') }}">Data Pegawai</a>
</li>
@endrole

{{-- Menu untuk Owner dan Teknisi --}}
@anyrole(['owner', 'teknisi'])
<li>
    <a href="{{ route('admin.teknisi.index') }}">Teknisi</a>
</li>
@endanyrole

{{-- Menu untuk semua role --}}
<li>
    <a href="{{ route('settings.index') }}">Pengaturan</a>
</li>
```

### **Controller Authorization**
```php
public function updateStatus(Request $request, $id)
{
    // Cek apakah user memiliki akses
    if (!auth()->user()->hasAnyRole(['admin', 'teknisi'])) {
        abort(403, 'Unauthorized action.');
    }

    // Logic update status
    $reservasi = Reservasi::findOrFail($id);
    $reservasi->update(['status' => $request->status]);

    return redirect()->route('admin.reservasi.index')
        ->with('success', 'Status berhasil diperbarui.');
}
```

## 🔍 Penggunaan di View

### **Menggunakan Helper Functions**
```blade
@role('admin')
    <div>Konten hanya untuk admin</div>
@endrole

@anyrole(['admin', 'teknisi'])
    <div>Konten untuk admin atau teknisi</div>
@endanyrole
```

### **Menggunakan Component**
```blade
<x-role-check :roles="['admin', 'teknisi']">
    <div>Konten untuk admin atau teknisi</div>
</x-role-check>
```

### **Menggunakan Method**
```blade
@if(auth()->user()->isAdmin())
    <div>Konten hanya untuk admin</div>
@endif

@if(auth()->user()->hasAnyRole(['admin', 'owner']))
    <div>Konten untuk admin atau owner</div>
@endif
```

## 🚀 Cara Test

### **1. Test sebagai Owner**
```bash
# Login dengan user yang memiliki role_id = 1
# Seharusnya bisa akses semua menu
```

### **2. Test sebagai Admin**
```bash
# Login dengan user yang memiliki role_id = 2
# Seharusnya bisa akses:
# - Dashboard
# - Daftar Reservasi
# - History Reservasi
# - Jenis Kerusakan
# - Jadwal
# - Data Pelanggan
# - Ulasan
# - Klaim Garansi
# - Pengaturan
# TIDAK BISA: Data Pegawai, Panel Teknisi
```

### **3. Test sebagai Teknisi**
```bash
# Login dengan user yang memiliki role_id = 3
# Seharusnya hanya bisa akses:
# - Dashboard
# - Panel Teknisi
# - Pengaturan
# TIDAK BISA: Semua menu admin lainnya
```

## 🔧 Troubleshooting

### **Jika menu tidak muncul:**
1. Pastikan user memiliki `role_id` yang benar (1, 2, atau 3)
2. Clear cache: `php artisan config:clear && php artisan view:clear`
3. Periksa apakah helper functions sudah terdaftar di `AppServiceProvider`

### **Jika mendapat error 403:**
1. Periksa middleware di routes
2. Pastikan user memiliki role yang diperlukan
3. Periksa `role_id` di database

### **Jika redirect ke login:**
1. Pastikan user sudah login
2. Periksa session configuration
3. Periksa authentication guard

## 📝 Catatan Penting

1. **Role ID Mapping:**
   - 1 = Owner
   - 2 = Admin  
   - 3 = Teknisi

2. **Database Structure:**
   - Tabel `users` memiliki kolom `role_id`
   - Tabel `roles` berisi mapping nama role

3. **Security:**
   - Semua routes dilindungi middleware
   - View menggunakan role checking
   - Controller memiliki authorization checks

4. **Maintenance:**
   - Clear cache setelah perubahan
   - Test dengan berbagai role
   - Monitor log untuk error 