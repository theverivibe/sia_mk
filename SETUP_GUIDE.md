# 📘 Panduan Setup & Konfigurasi

## ✅ Yang Sudah Dikonfigurasi

### 1. **Laravel Breeze + Livewire** ✓
- Authentication system (Login, Register, Profile, Password Reset)
- Livewire components untuk dynamic UI
- Tailwind CSS untuk styling

### 2. **Database Structure** ✓
```
✓ asset_categories - Kategori aset
✓ assets - Data inventaris aset
✓ complaints - Data komplain/tiket
✓ users - Data pengguna
```

### 3. **Models & Relations** ✓
- `Asset` model dengan relasi ke Category & User
- `Complaint` model dengan auto-generated ticket number
- `AssetCategory` model
- Semua model sudah include soft deletes

### 4. **Livewire Components** ✓
- `Dashboard` - Halaman dashboard dengan statistik
- `Assets/Index` - List aset dengan filter & search
- `Complaints/Index` - List komplain dengan filter & search

### 5. **Routes** ✓
```php
/dashboard           - Dashboard utama
/assets              - Manajemen aset
/complaints          - Manajemen komplain
/profile             - Profile user
/login, /register    - Authentication
```

### 6. **Navigation Menu** ✓
- Menu Dashboard, Aset, Komplain sudah ditambahkan
- Responsive navigation untuk mobile

### 7. **Seeders** ✓
- 6 kategori aset default
- 2 user (admin & test user)

## 🚀 Cara Menjalankan Aplikasi

### 1. Pastikan Server Sudah Berjalan
```bash
php artisan serve
```
Aplikasi akan berjalan di: `http://localhost:8000`

### 2. Login ke Aplikasi
**Admin Account:**
- Email: `admin@example.com`
- Password: `password`

**Test User:**
- Email: `test@example.com`  
- Password: `password`

## 📊 Fitur yang Tersedia Saat Ini

### ✅ Sudah Berfungsi:
1. **Authentication** - Login, register, profile
2. **Dashboard** - Menampilkan statistik dan data terbaru
3. **Assets List** - Menampilkan daftar aset dengan:
   - Search by nama/kode/serial
   - Filter by kategori, status, kondisi
   - Pagination
4. **Complaints List** - Menampilkan daftar komplain dengan:
   - Search by ticket/judul/deskripsi
   - Filter by status, prioritas
   - Pagination

### 🔧 Masih Perlu Dikembangkan:
1. **Form Create/Edit** untuk Aset & Komplain
2. **Detail View** untuk melihat informasi lengkap
3. **Delete Function** dengan konfirmasi
4. **Image Upload** untuk aset dan komplain
5. **Status Update** untuk komplain
6. **Assignment** teknisi ke komplain

## 🛠️ Langkah Pengembangan Selanjutnya

### 1. Membuat Form Create Asset
```bash
php artisan make:livewire Assets/Create
```

### 2. Membuat Form Edit Asset
```bash
php artisan make:livewire Assets/Edit
```

### 3. Membuat Detail View
```bash
php artisan make:livewire Assets/Show
php artisan make:livewire Complaints/Show
```

### 4. Menambahkan File Upload
- Install Laravel Media Library atau custom upload
- Update migration untuk storage path
- Implement upload di form

### 5. Membuat Notification System
```bash
php artisan notifications:table
php artisan migrate
```

## 📝 Catatan Penting

### Status Aset:
- `tersedia` - Aset siap digunakan
- `digunakan` - Sedang dipakai user
- `dalam_perbaikan` - Sedang diperbaiki
- `dihapuskan` - Tidak digunakan lagi

### Kondisi Aset:
- `baik` - Kondisi normal
- `rusak_ringan` - Perlu perawatan kecil
- `rusak_berat` - Perlu perbaikan besar
- `perlu_perbaikan` - Butuh maintenance

### Status Komplain:
- `baru` - Baru dilaporkan
- `diproses` - Sedang ditangani
- `selesai` - Sudah diselesaikan
- `ditolak` - Ditolak/invalid

### Prioritas Komplain:
- `rendah` - Tidak mendesak
- `sedang` - Normal priority
- `tinggi` - Perlu segera
- `urgent` - Sangat mendesak

## 🎨 Customization

### Mengubah Warna Tema
Edit file `resources/css/app.css` atau konfigurasi Tailwind

### Menambah Kategori Aset
```bash
php artisan tinker
```
```php
App\Models\AssetCategory::create([
    'name' => 'Nama Kategori',
    'description' => 'Deskripsi',
    'code' => 'CODE'
]);
```

### Menambah User
```bash
php artisan tinker
```
```php
App\Models\User::create([
    'name' => 'Nama User',
    'email' => 'email@example.com',
    'password' => bcrypt('password')
]);
```

## 🐛 Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: Database tidak terkoneksi
Cek file `.env` dan pastikan database path benar

### Halaman blank/error
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)

---

**Happy Coding! 🚀**
