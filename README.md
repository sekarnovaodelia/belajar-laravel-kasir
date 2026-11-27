```markdown
# 🛒 Kasir App - Aplikasi Point of Sale (POS) Berbasis Laravel

Aplikasi kasir (Point of Sale) modern yang dibangun menggunakan **Laravel 8** dan **Bootstrap 5**. Aplikasi ini dirancang untuk mempermudah pengelolaan transaksi, stok barang, data pelanggan, dan laporan penjualan dengan antarmuka yang bersih, modern, dan responsif.

![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=for-the-badge&logo=laravel)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)

---

## ✨ Fitur Utama

Aplikasi ini memiliki dua level pengguna (**Admin** dan **Kasir**) dengan hak akses yang berbeda:

### 🛡️ Fitur Admin
- **Dashboard Interaktif**: Menampilkan ringkasan total barang, pelanggan, transaksi, dan grafik pendapatan 7 hari terakhir.
- **Master Data**: Kelola (CRUD) Jenis Barang, Barang, dan Supplier.
- **Manajemen Stok**: Mencatat barang masuk (restock) dari supplier, stok otomatis bertambah.
- **Laporan**: Filter laporan transaksi berdasarkan rentang tanggal dan export ke **PDF**.
- **Manajemen Pengguna**: Melihat daftar user (Kasir/Admin).

### 💳 Fitur Kasir
- **Kasir (POS)**: Antarmuka khusus kasir dengan fitur **Keranjang (Cart)**. Mendukung pembelian banyak barang sekaligus.
- **Pencarian & Filter**: Cari barang dengan cepat berdasarkan nama atau kelompok jenis barang.
- **Pelanggan**: Input pelanggan terdaftar (member) atau pelanggan manual (walk-in).
- **Cetak Struk**: Struk pembayaran otomatis ter-generate setelah transaksi selesai.
- **Validasi Stok**: Mencegah transaksi jika stok barang tidak mencukupi.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: [Laravel 8](https://laravel.com/)
- **Frontend**: [Bootstrap 5](https://getbootstrap.com/), [Bootstrap Icons](https://icons.getbootstrap.com/), [Chart.js](https://www.chartjs.org/)
- **Database**: MySQL
- **Arsitektur**: MVC (Model-View-Controller) dengan *Service Pattern* untuk memisahkan logika bisnis.
- **PDF Generator**: [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)

---

## 📸 Tampilan Aplikasi (Screenshots)

*(Tambahkan screenshot aplikasi Anda di sini. Caranya: buat folder `screenshots/` di project Anda, masukkan gambar, lalu panggil di sini)*

| Halaman Kasir (POS) | Dashboard Admin |
|:---:|:---:|
| *Ganti dengan link gambar* | *Ganti dengan link gambar* |

---

## 🚀 Cara Instalasi & Menjalankan

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer Anda:

### Prasyarat
- PHP >= 8.1 (Disarankan PHP 8.1 karena kompatibel dengan Laravel 8)
- Composer
- MySQL
- Web Server (Laragon/XAMPP)

### Langkah-langkah

1. **Clone Repository**
   ```bash
   git clone https://github.com/sekarnovaodelia/belajar-laravel-kasir.git
   cd belajar-laravel-kasir
   ```

2. **Install Dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   Copy file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kasir_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Seeder**
   *(Pastikan Anda sudah membuat database kosong bernama `kasir_db` di MySQL)*
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Buka browser dan akses `http://localhost:8000` atau `http://kasir-laravel.test` (jika pakai Laragon).

---

## 🔑 Akun Demo (Default)

Setelah menjalankan `php artisan db:seed`, Anda bisa login menggunakan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@kasir.test` | `123456` |
| **Kasir** | `kasir@kasir.test` | `123456` |

*(Silakan cek file `database/seeders/UserSeeder.php` jika berbeda)*

---

## 📂 Struktur Folder Penting

```text
app/
├── Http/Controllers/    # Logika Request & Response
├── Models/              # Representasi Data (Eloquent)
└── Services/            # Logika Bisnis (StokMasukService, TransaksiService)

resources/views/
├── layouts/             # Template utama (app.blade.php)
├── partials/            # Komponen UI (sidebar, topbar, footer)
├── barang/              # View master barang
├── transaksi/           # View POS & Laporan
└── ...                  # View lainnya
```

---

## 👩‍💻 Pengembang

Dibuat dan dikembangkan oleh **Sekar Nova Odelia**.

- **Lisensi**: Project ini bersifat open-source dan bebas digunakan untuk tujuan pembelajaran.

---

<p align="center">
  <i>Dibuat dengan ❤️ dan ☕ untuk kemajuan belajar programming.</i>
</p>
```