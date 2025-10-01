# 🔄 Database Migration: SQLite → MySQL

## ✅ Migrasi Database Berhasil!

Database proyek sudah berhasil diubah dari **SQLite** ke **MySQL**.

---

## 📊 Informasi Database

### Database Configuration:
```
Database: sia_mk
Host: 127.0.0.1
Port: 3306
User: root
Password: (empty)
```

---

## 🔧 Perubahan yang Dilakukan

### 1. Update File `.env`
```env
# SEBELUM (SQLite)
DB_CONNECTION=sqlite

# SESUDAH (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sia_mk
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Fix Migration Order
**Masalah:** Tabel `assets` dibuat sebelum `asset_categories`, padahal `assets` punya foreign key ke `asset_categories`.

**Solusi:** Rename migration file:
- **SEBELUM:** `2025_10_01_052335_create_asset_categories_table.php`
- **SESUDAH:** `2025_10_01_052310_create_asset_categories_table.php`

Ini memastikan `asset_categories` dibuat **SEBELUM** `assets`.

### 3. Fresh Migration
```bash
php artisan migrate:fresh
php artisan db:seed
```

---

## ✅ Status Migrasi

### Tables Created Successfully:

| # | Table | Status | Records |
|---|-------|--------|---------|
| 1 | migrations | ✅ Created | 6 migrations |
| 2 | users | ✅ Created | 2 users |
| 3 | cache | ✅ Created | - |
| 4 | cache_locks | ✅ Created | - |
| 5 | jobs | ✅ Created | - |
| 6 | job_batches | ✅ Created | - |
| 7 | failed_jobs | ✅ Created | - |
| 8 | password_reset_tokens | ✅ Created | - |
| 9 | sessions | ✅ Created | - |
| 10 | asset_categories | ✅ Created | 6 categories |
| 11 | assets | ✅ Created | 0 assets |
| 12 | complaints | ✅ Created | 0 complaints |

---

## 🎯 Data yang Di-seed

### Users (2):
1. **Admin**
   - Email: `admin@example.com`
   - Password: `password`

2. **Test User**
   - Email: `test@example.com`
   - Password: `password`

### Asset Categories (6):
1. **KOMP** - Komputer & Laptop
2. **NET** - Peralatan Jaringan
3. **FURN** - Furniture
4. **ELEK** - Elektronik
5. **VHCL** - Kendaraan
6. **OFFC** - Peralatan Kantor

---

## 🚀 Cara Verifikasi Koneksi MySQL

### 1. Check Migration Status:
```bash
php artisan migrate:status
```

### 2. Test Database Connection:
```bash
php artisan tinker
```
```php
// Check users count
App\Models\User::count();

// Check categories
App\Models\AssetCategory::all();

// Check database name
DB::connection()->getDatabaseName();
```

### 3. Via MySQL Client:
```bash
mysql -u root -p
```
```sql
USE sia_mk;
SHOW TABLES;
SELECT * FROM users;
SELECT * FROM asset_categories;
```

---

## 🔍 Perbedaan SQLite vs MySQL

### SQLite (Sebelumnya):
- ✅ File-based database
- ✅ Tidak perlu service terpisah
- ✅ Cocok untuk development kecil
- ❌ Tidak cocok untuk production
- ❌ Concurrent access terbatas

### MySQL (Sekarang):
- ✅ Production-ready
- ✅ Better concurrent access
- ✅ More powerful features
- ✅ Scalable
- ✅ Industry standard
- ❌ Perlu MySQL service running
- ❌ Perlu konfigurasi tambahan

---

## ⚙️ Konfigurasi MySQL Tambahan (Optional)

### Optimasi untuk Development:

**File: `config/database.php`**

Jika perlu, tambahkan konfigurasi:

```php
'mysql' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
    
    // Tambahan untuk optimasi
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        PDO::ATTR_EMULATE_PREPARES => true,
    ]) : [],
],
```

---

## 🛠️ Troubleshooting MySQL

### Error: "Access denied for user 'root'@'localhost'"

**Solusi:**
```bash
# Reset MySQL root password atau update .env
DB_PASSWORD=your_mysql_password
```

### Error: "Unknown database 'sia_mk'"

**Solusi:**
```bash
# Buat database terlebih dahulu
mysql -u root -p
CREATE DATABASE sia_mk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### Error: "Can't connect to MySQL server"

**Solusi:**
1. Pastikan MySQL service running:
   - Windows: Cek Services → MySQL
   - XAMPP: Start MySQL di control panel
   - MAMP/WAMP: Start MySQL service

2. Check port 3306 tidak dipakai aplikasi lain

---

## 🔄 Rollback ke SQLite (Jika Perlu)

Jika ingin kembali ke SQLite:

### 1. Update `.env`:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sia_mk
# DB_USERNAME=root
# DB_PASSWORD=
```

### 2. Run Migration:
```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

---

## 📝 Backup Database

### Export Database (Backup):
```bash
# Via mysqldump
mysqldump -u root -p sia_mk > backup_sia_mk.sql

# Atau via phpMyAdmin
# 1. Buka phpMyAdmin
# 2. Pilih database sia_mk
# 3. Klik "Export"
# 4. Download file SQL
```

### Import Database (Restore):
```bash
# Via mysql command
mysql -u root -p sia_mk < backup_sia_mk.sql

# Atau via phpMyAdmin
# 1. Buka phpMyAdmin
# 2. Pilih database sia_mk
# 3. Klik "Import"
# 4. Upload file SQL backup
```

---

## 🎯 Migration Commands Reference

### Useful Commands:
```bash
# Cek status migration
php artisan migrate:status

# Run migration
php artisan migrate

# Rollback migration terakhir
php artisan migrate:rollback

# Rollback semua migration
php artisan migrate:reset

# Fresh migration (drop all + migrate)
php artisan migrate:fresh

# Fresh migration + seed
php artisan migrate:fresh --seed

# Refresh migration (rollback + migrate)
php artisan migrate:refresh

# Refresh migration + seed
php artisan migrate:refresh --seed
```

---

## ✅ Checklist Post-Migration

- [x] Database `sia_mk` sudah dibuat
- [x] File `.env` sudah diupdate
- [x] Migration order sudah diperbaiki
- [x] Semua tabel sudah dibuat
- [x] Data seeder sudah dijalankan
- [x] User accounts sudah tersedia
- [x] Asset categories sudah tersedia
- [x] Config cache sudah di-clear
- [x] Aplikasi sudah bisa diakses

---

## 🎊 Hasil Akhir

### ✅ Database MySQL `sia_mk` Sudah Aktif!

Aplikasi sekarang menggunakan MySQL database dengan nama `sia_mk`.

**Struktur database lengkap dengan:**
- ✅ User management
- ✅ Asset categories
- ✅ Assets inventory
- ✅ Complaints system
- ✅ Jobs & cache tables
- ✅ Session management

**Data awal:**
- ✅ 2 users (admin & test)
- ✅ 6 asset categories

---

## 🚀 Next Steps

1. **Test aplikasi** - Login dan pastikan semua berfungsi
2. **Tambah data** - Mulai input aset & komplain
3. **Backup database** - Secara berkala backup data
4. **Monitor performance** - MySQL lebih powerful untuk data banyak

---

**Database migration selesai!** 🎉

*Last Updated: October 1, 2025*
