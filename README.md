# 📦 Sistem Inventaris Aset & Manajemen Komplain

Aplikasi berbasis web untuk mengelola inventaris aset dan sistem manajemen komplain yang dibangun menggunakan **Laravel 12** dan **Laravel Breeze + Livewire**.

## ✨ Fitur Utama

### 📊 Dashboard
- Statistik real-time total aset, status aset (tersedia, digunakan, dll)
- Monitoring komplain (baru, diproses, selesai)
- Quick actions untuk akses cepat ke fitur utama
- Daftar aset dan komplain terbaru

### 🏢 Manajemen Aset
- **CRUD Aset Lengkap** dengan informasi detail:
  - Kode aset unik
  - Kategori aset (Komputer, Jaringan, Furniture, dll)
  - Brand, model, dan serial number
  - Tanggal dan harga pembelian
  - Status: Tersedia, Digunakan, Dalam Perbaikan, Dihapuskan
  - Kondisi: Baik, Rusak Ringan, Rusak Berat, Perlu Perbaikan
  - Lokasi dan pengguna yang ditugaskan
  - Upload gambar aset
  - Catatan tambahan

- **Filter & Pencarian**:
  - Pencarian by nama, kode, atau serial number
  - Filter by kategori
  - Filter by status
  - Filter by kondisi

### 🎫 Manajemen Komplain
- **Sistem Tiket Otomatis** (Format: TKT-YYYYMMDD-XXXX)
- **Informasi Komplain**:
  - Judul dan deskripsi lengkap
  - Aset terkait (optional)
  - Prioritas: Rendah, Sedang, Tinggi, Urgent
  - Status: Baru, Diproses, Selesai, Ditolak
  - Assigned teknisi
  - Upload gambar/screenshot
  - Resolusi dan waktu penyelesaian

- **Filter & Pencarian**:
  - Pencarian by ticket number, judul, atau deskripsi
  - Filter by status
  - Filter by prioritas

### 🔐 Autentikasi
- Login & Register (Laravel Breeze)
- Profile management
- Email verification
- Password reset

## 🛠️ Teknologi yang Digunakan

- **Laravel 12** - PHP Framework
- **Laravel Breeze** - Authentication starter kit
- **Livewire 3** - Full-stack framework for dynamic interfaces
- **Tailwind CSS** - Utility-first CSS framework
- **MySQL** - Database (sia_mk)
- **Vite** - Frontend build tool

## 📋 Struktur Database

### Tabel: `asset_categories`
- `id`, `name`, `description`, `code`

### Tabel: `assets`
- Asset details, category relation, user assignment
- Status & condition tracking
- Soft deletes enabled

### Tabel: `complaints`
- Auto-generated ticket number
- Asset relation (optional)
- User tracking (reporter & assigned technician)
- Priority & status management
- Soft deletes enabled

## 🚀 Instalasi & Setup

Proyek ini sudah dikonfigurasi dengan lengkap. Untuk menjalankan:

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations & seeders
php artisan migrate --seed

# Build assets
npm run build

# Start development server
php artisan serve
```

## 👤 Login Credentials

Setelah menjalankan seeder, gunakan kredensial berikut:

**Admin:**
- Email: `admin@example.com`
- Password: `password`

**Test User:**
- Email: `test@example.com`
- Password: `password`

## 📁 Struktur Kategori Aset (Default)

1. **KOMP** - Komputer & Laptop
2. **NET** - Peralatan Jaringan
3. **FURN** - Furniture
4. **ELEK** - Elektronik
5. **VHCL** - Kendaraan
6. **OFFC** - Peralatan Kantor

## 🎯 Roadmap / Fitur Selanjutnya

- [ ] Form tambah/edit aset & komplain
- [ ] Detail view untuk aset & komplain
- [ ] Export data ke Excel/PDF
- [ ] Notification system
- [ ] Role & Permission management
- [ ] Asset maintenance tracking
- [ ] Complaint history & comments
- [ ] File attachments untuk aset & komplain
- [ ] QR Code generator untuk aset
- [ ] Dashboard analytics & charts
- [ ] API endpoints

## 📝 Catatan Pengembangan

Proyek ini menggunakan **Laravel Breeze + Livewire** sebagai starter kit karena:
- ✅ Lebih fleksibel untuk custom development
- ✅ Component-based architecture
- ✅ Real-time reactivity tanpa JavaScript framework kompleks
- ✅ Cocok untuk aplikasi CRUD intensive seperti inventaris

**Note:** Filament v3 belum support Laravel 12, sehingga digunakan Breeze sebagai alternatif yang lebih kompatibel.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
