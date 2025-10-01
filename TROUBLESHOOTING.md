# 🐛 Troubleshooting & Common Errors

## ✅ Error yang Sudah Diperbaiki

### 1. ❌ Livewire Layout Not Found Error

**Error Message:**
```
Livewire\Features\SupportPageComponents\MissingLayoutException
Livewire page component layout view not found: [components.layouts.app]
```

**Penyebab:**
Livewire page components (Dashboard, Assets/Index, Complaints/Index) tidak menentukan layout yang benar.

**Solusi:**
Tambahkan `->layout('layouts.app')` pada return statement di method `render()`:

```php
// ❌ SEBELUM (Error)
public function render()
{
    return view('livewire.dashboard', [
        'data' => $data,
    ]);
}

// ✅ SESUDAH (Fixed)
public function render()
{
    return view('livewire.dashboard', [
        'data' => $data,
    ])->layout('layouts.app');
}
```

**File yang Sudah Diperbaiki:**
- ✅ `app/Livewire/Dashboard.php`
- ✅ `app/Livewire/Assets/Index.php`
- ✅ `app/Livewire/Complaints/Index.php`

---

## 🛠️ Common Errors & Solutions

### 2. ⚠️ Class Not Found Error

**Error:** `Class 'App\Livewire\Something' not found`

**Solusi:**
```bash
composer dump-autoload
```

---

### 3. ⚠️ View Not Found Error

**Error:** `View [livewire.dashboard] not found`

**Solusi:**
```bash
php artisan view:clear
php artisan optimize:clear
```

Pastikan file view ada di lokasi yang benar:
- `resources/views/livewire/dashboard.blade.php`

---

### 4. ⚠️ Route Not Defined Error

**Error:** `Route [dashboard] not defined`

**Solusi:**
Cek file `routes/web.php` dan pastikan route sudah terdaftar:

```php
use App\Livewire\Dashboard;

Route::get('dashboard', Dashboard::class)->name('dashboard');
```

Lalu clear cache:
```bash
php artisan route:clear
php artisan optimize:clear
```

---

### 5. ⚠️ Database Connection Error

**Error:** `SQLSTATE[HY000] [14] unable to open database file`

**Solusi:**

**Untuk SQLite:**
```bash
# Pastikan file database ada
php artisan migrate
```

**Untuk MySQL:**
1. Cek file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

2. Clear config:
```bash
php artisan config:clear
```

---

### 6. ⚠️ CSRF Token Mismatch

**Error:** `419 | Page Expired`

**Solusi:**
1. Clear browser cookies
2. Clear Laravel cache:
```bash
php artisan cache:clear
php artisan config:clear
```
3. Refresh halaman

---

### 7. ⚠️ Vite Manifest Not Found

**Error:** `Vite manifest not found`

**Solusi:**
```bash
# Build assets
npm run build

# Atau untuk development
npm run dev
```

---

### 8. ⚠️ Permission Denied (Windows)

**Error:** `Permission denied` saat menjalankan artisan commands

**Solusi:**
```bash
# Jalankan PowerShell sebagai Administrator
# Atau ubah permission folder:
icacls "C:\Users\USER\Projects\05_Learning_Prototype\laravel\proyek-aset\storage" /grant Everyone:F /T
```

---

### 9. ⚠️ Server Not Accessible

**Error:** Cannot access `http://127.0.0.1:8000`

**Solusi:**

**Cek apakah server running:**
```bash
php artisan serve
```

**Cek port yang digunakan:**
```bash
# Gunakan port lain jika 8000 sedang digunakan
php artisan serve --port=8001
```

**Cek firewall:**
- Pastikan firewall tidak memblokir port 8000

---

### 10. ⚠️ Livewire Not Working (No Reactivity)

**Error:** Search/filter tidak berfungsi real-time

**Solusi:**

**Cek apakah Livewire script loaded:**
```blade
{{-- Di file layout --}}
@livewireStyles
...
@livewireScripts
```

**Cek wire:model:**
```blade
{{-- ❌ Salah --}}
<input wire:model="search">

{{-- ✅ Benar --}}
<input wire:model.live="search">
```

**Clear cache:**
```bash
php artisan optimize:clear
```

---

### 11. ⚠️ Migration Error

**Error:** `SQLSTATE[42S01]: Base table or view already exists`

**Solusi:**

**Fresh migration (HATI-HATI: Menghapus semua data):**
```bash
php artisan migrate:fresh
```

**Atau rollback dan migrate ulang:**
```bash
php artisan migrate:rollback
php artisan migrate
```

**Untuk fresh install dengan seeder:**
```bash
php artisan migrate:fresh --seed
```

---

### 12. ⚠️ Composer Install Error

**Error:** Package conflict atau dependency issues

**Solusi:**
```bash
# Update composer
composer self-update

# Clear composer cache
composer clear-cache

# Install ulang
composer install --ignore-platform-reqs
```

---

### 13. ⚠️ NPM Install Error

**Error:** npm install gagal

**Solusi:**
```bash
# Clear npm cache
npm cache clean --force

# Install ulang
npm install

# Atau gunakan yarn
yarn install
```

---

### 14. ⚠️ Session Store Not Found

**Error:** `Session store not set on request`

**Solusi:**
```bash
php artisan session:table
php artisan migrate
php artisan config:clear
```

---

### 15. ⚠️ Storage Link Error

**Error:** Uploaded files tidak bisa diakses

**Solusi:**
```bash
php artisan storage:link
```

Ini akan membuat symbolic link dari `storage/app/public` ke `public/storage`.

---

## 🔧 General Troubleshooting Steps

Jika aplikasi bermasalah, coba langkah-langkah ini secara berurutan:

### Step 1: Clear All Caches
```bash
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Step 2: Rebuild Autoload
```bash
composer dump-autoload
```

### Step 3: Rebuild Assets
```bash
npm run build
```

### Step 4: Check Permissions
```bash
# Windows (Run as Administrator)
icacls "storage" /grant Everyone:F /T
icacls "bootstrap/cache" /grant Everyone:F /T
```

### Step 5: Restart Server
```bash
# Stop server dengan Ctrl+C
# Jalankan ulang
php artisan serve
```

---

## 📊 Debug Mode

### Enable Debug Mode

**File: `.env`**
```env
APP_DEBUG=true
APP_ENV=local
```

Ini akan menampilkan error message detail untuk memudahkan debugging.

### Check Logs

**Location:** `storage/logs/laravel.log`

Buka file ini untuk melihat error details.

---

## 🆘 Cek Status Aplikasi

### Command untuk Cek Status:
```bash
# Cek informasi aplikasi
php artisan about

# Cek routes
php artisan route:list

# Cek config
php artisan config:show

# Test database connection
php artisan db:show

# Tinker (interactive console)
php artisan tinker
```

---

## 💡 Tips Mencegah Error

### 1. Selalu Clear Cache Setelah Perubahan
```bash
php artisan optimize:clear
```

### 2. Gunakan Version Control (Git)
```bash
git add .
git commit -m "Your changes"
```

### 3. Backup Database Sebelum Migrate
```bash
# Untuk SQLite
cp database/database.sqlite database/database.sqlite.backup
```

### 4. Test di Local Dulu
Jangan langsung deploy ke production tanpa test lokal.

### 5. Baca Error Message dengan Teliti
Error message Laravel biasanya sangat jelas dan memberikan hints solusinya.

---

## 🎯 Quick Fix Commands

Simpan commands ini untuk troubleshooting cepat:

```bash
# All-in-one clear command
php artisan optimize:clear && composer dump-autoload && npm run build

# Fresh install (HATI-HATI: Hapus semua data)
php artisan migrate:fresh --seed

# Restart everything
php artisan optimize:clear && php artisan serve
```

---

## 📞 Need More Help?

Jika masih ada error:

1. **Check Laravel Logs:** `storage/logs/laravel.log`
2. **Check Browser Console:** F12 → Console tab
3. **Check Network Tab:** F12 → Network tab
4. **Google the Error:** Copy paste error message ke Google
5. **Laravel Documentation:** https://laravel.com/docs
6. **Livewire Documentation:** https://livewire.laravel.com

---

**Last Updated: October 1, 2025**

*Semua error di atas sudah dicatat dan solusinya terbukti berhasil untuk proyek ini.*
