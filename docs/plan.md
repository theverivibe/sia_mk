***
## **Blueprint Proyek: Sistem Manajemen Aset & Komplain Terpusat**

### ## 1. Tentang Apa Proyek Ini?

Ini adalah sistem informasi berbasis web yang dirancang untuk menjadi **pusat kendali tunggal (single source of truth)** untuk semua aset perusahaan dan alur kerja komplain IT. Tujuannya adalah untuk menggantikan proses manual yang saat ini menggunakan Excel dan WhatsApp, dengan sebuah platform digital yang terstruktur, efisien, dan transparan.

---
### ## 2. Masalah Apa yang Diselesaikan?

Sistem ini dirancang untuk memberantas masalah-masalah spesifik berikut:
* **Inefisiensi Pelacakan Aset:** Menghilangkan penggunaan file-file Excel yang tersebar dan tidak terpusat, yang menyulitkan pelacakan riwayat dan status aset secara akurat.
* **Manajemen Komplain yang Kacau:** Menggantikan komunikasi via grup WhatsApp yang tidak terstruktur dengan sistem tiket yang rapi, memastikan setiap keluhan tercatat, ditugaskan, dan bisa dilacak status penyelesaiannya.
* **Proses Pelaporan Manual yang Melelahkan:** Mengotomatiskan pembuatan laporan harian, mingguan, dan bulanan. Ini menghapus kebutuhan untuk mengisi formulir kertas, meminta tanda tangan, dan mengirim banyak email laporan secara manual setiap hari.
* **Kurangnya Visibilitas untuk Manajemen:** Memberikan akses *real-time* bagi manajemen (Principal) untuk memantau status aset, beban kerja tim IT, dan penyelesaian komplain tanpa harus menunggu laporan manual.

---
### ## 3. Apa Saja Fitur Utamanya?

* **Manajemen Aset Terpusat:** Database tunggal untuk semua aset perusahaan, lengkap dengan detail, riwayat, dan penugasan ke pengguna.
* **Sistem Tiket Komplain:** Alur kerja terstruktur untuk melaporkan dan menangani keluhan, baik terkait aset (via scan QR Code) maupun masalah umum.
* **Dashboard & Pelaporan:** Tampilan visual untuk statistik kunci dan kemampuan untuk men-generate laporan PDF/Excel sesuai kebutuhan.
* **Manajemen Peran & Pengguna:** Sistem hak akses yang jelas untuk membatasi fungsionalitas berdasarkan peran pengguna.
* **Kalender Aktivitas:** Tampilan kalender interaktif untuk manajemen, yang merangkum semua aktivitas penting dalam sistem (log aset, komplain, dll).
* **Notifikasi Otomatis:** Pemberitahuan (via email) untuk setiap pembaruan penting, seperti adanya komplain baru atau perubahan status.

---
### ## 4. Apa Saja Role yang Ada & Hak Aksesnya?

#### ### Staff IT
* **Tugas Utama:** Administrator dan pelaksana teknis utama sistem.
* **Hak Akses:**
    * ✅ Akses penuh untuk Mengelola (Tambah, Lihat, Edit, Hapus) data **Aset** dan **Kategori**.
    * ✅ Dapat menetapkan Aset ke Pengguna.
    * ✅ Dapat melihat dan memproses **semua Komplain**.
    * ✅ Akses penuh untuk Mengelola data **Pengguna**.
    * ✅ Dapat melihat **Kalender Aktivitas** dan semua **Laporan**.

#### ### Principal
* **Tugas Utama:** Pengawas manajerial yang memantau kinerja dan alur kerja.
* **Hak Akses:**
    * ✅ Dapat **melihat** daftar semua Aset (data public dan private).
    * ✅ Dapat **melihat** daftar semua Komplain dan statusnya.
    * ✅ Dapat mengakses **Kalender Aktivitas** untuk memantau log sistem.
    * ✅ Dapat men-generate dan mengunduh semua jenis **Laporan**.
    * ❌ **Tidak bisa** menambah, mengedit, atau menghapus data apa pun.

#### ### User
* **Tugas Utama:** Pengguna akhir yang berinteraksi dengan sistem untuk kebutuhan pribadi.
* **Hak Akses:**
    * ✅ Dapat **melihat** daftar Aset miliknya sendiri (hanya data public).
    * ✅ Dapat **mengunduh laporan** PDF/Excel dari Aset miliknya.
    * ✅ Dapat **mengajukan Komplain** baru (terkait aset atau umum).
    * ✅ Dapat **melihat riwayat dan status** dari Komplain miliknya sendiri.
    * ❌ **Tidak bisa** melihat aset atau komplain milik pengguna lain.

---
### ## 5. Bagaimana Menu/Halaman dari Masing-Masing Role?

#### ### Staff IT
* **Dashboard:** Statistik kunci (aset, komplain baru, dll).
* **Aset:** Tabel semua aset dengan fitur search/filter. (Tombol: Tambah, Edit, Hapus).
* **Komplain:** Tabel semua komplain masuk. (Fitur: Ubah Status, Tugaskan, Komentar).
* **Pengguna:** Tabel semua pengguna. (Tombol: Tambah, Edit Role, Hapus).
* **Kalender:** Tampilan kalender log aktivitas.

#### ### Principal
* **Dashboard:** Statistik dan ringkasan laporan.
* **Aset:** Tabel semua aset (hanya bisa melihat).
* **Komplain:** Tabel semua komplain (hanya bisa melihat).
* **Kalender:** Tampilan kalender log aktivitas.
* **Laporan:** Halaman untuk memilih jenis laporan dan rentang tanggal untuk diunduh.

#### ### User
* **Aset Saya:** Daftar aset yang ditugaskan kepadanya. (Tombol: Download Laporan).
* **Komplain Saya:** Daftar riwayat komplain miliknya.
* **Ajukan Komplain:** Halaman form untuk membuat laporan keluhan baru.

---
### ## 6. Bagaimana Alur Kerja (Workflow) Sistem Ini?

#### **Alur A: Penanganan Komplain Aset via QR Code**
1.  **User** menemukan laptopnya bermasalah.
2.  User memindai **QR code** yang tertempel di laptop menggunakan kamera HP.
3.  HP membuka halaman web detail laptop tersebut di sistem.
4.  User mengklik tombol "Laporkan Masalah", lalu mengisi form singkat (hanya deskripsi dan foto).
5.  **Staff IT** menerima notifikasi email bahwa ada komplain baru.
6.  Staff IT membuka sistem, mengubah status komplain menjadi "In Progress" dan memberikan komentar.
7.  **User** menerima email bahwa komplainnya sedang ditangani.
8.  Setelah masalah selesai, Staff IT mengubah status menjadi "Resolved".
9.  **Principal**, saat membuka **Kalender**, akan melihat log bahwa "Komplain #XYZ telah diselesaikan".

#### **Alur B: Pelaporan Bulanan oleh Principal**
1.  Di awal bulan, **Principal** ingin melihat rekap semua aset yang dibeli bulan lalu.
2.  Principal login, masuk ke menu **"Laporan"**.
3.  Dia memilih jenis laporan "Laporan Pembelian Aset Baru".
4.  Dia mengatur rentang tanggal ke bulan sebelumnya.
5.  Dia mengklik **"Download PDF"**.
6.  Sistem secara otomatis menghasilkan file PDF yang rapi dan siap untuk disimpan atau dibagikan. Proses selesai dalam kurang dari 1 menit.

---
### ## 7. Fitur Masa Depan yang Akan Ditambahkan

* **Integrasi Notifikasi WhatsApp:** Selain email, notifikasi penting (seperti komplain baru dengan prioritas tinggi) akan dikirim langsung ke WhatsApp Staff IT.
* **Saran Aset Berbasis AI:** Sistem akan memberikan rekomendasi cerdas, misalnya: "Aset Laptop ABC sudah berusia 4 tahun dan telah dikomplain sebanyak 8 kali. Direkomendasikan untuk diganti."