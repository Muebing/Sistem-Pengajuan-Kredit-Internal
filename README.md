<h1 align="center">Capella Multidana</h1>
<h3 align="center">Sistem Pengajuan Kredit Internal</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.8-FF2D20?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.0-06B6D4?style=flat-square&logo=tailwindcss" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-8.0-646CFF?style=flat-square&logo=vite" alt="Vite">
  <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql" alt="MySQL">
</p>

---

## Tentang Proyek

**Capella Multidana** adalah aplikasi prototipe pengajuan kredit untuk pengguna internal. Aplikasi ini memungkinkan staf untuk mengelola pengajuan pinjaman nasabah — mulai dari membuat pengajuan baru, memfilter daftar pengajuan, hingga menyetujui atau menolak pengajuan.

### Tech Stack

| Komponen | Teknologi                                   |
| -------- | ------------------------------------------- |
| Backend  | Laravel 13.8, PHP 8.3+                      |
| Frontend | Blade Templates, Tailwind CSS 4.0, Vite 8.0 |
| Database | MySQL 8.x                                   |
| Testing  | PHPUnit 12.5                                |

---

## Persyaratan

Sebelum memulai, pastikan komputer Anda telah menginstal:

| Software | Versi Minimal | Catatan                                                                                              |
| -------- | ------------- | ---------------------------------------------------------------------------------------------------- |
| PHP      | 8.3           | Berserta ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath` |
| Composer | 2.x           | [composer.org](https://getcomposer.org/)                                                             |
| Node.js  | 18+           | Untuk build aset frontend                                                                            |
| MySQL    | 8.0           | Atau MariaDB 10.3+                                                                                   |
| Laragon  | (opsional)    | Sangat disarankan untuk pengembangan di Windows                                                      |

---

## Instalasi

### 1. Clone repository

```bash
git clone https://github.com/Muebing/Sistem-Pengajuan-Kredit-Internal
cd Credit-Submission-Prototype
```

### 2. Instalasi otomatis ( satu perintah )

```bash
composer setup
```

Perintah ini akan menjalankan:

- `composer install` — instal dependensi PHP
- Salin `.env.example` ke `.env` (jika belum ada)
- `php artisan key:generate` — buat application key
- `php artisan migrate --force` — jalankan migrasi database
- `npm install --ignore-scripts` — instal dependensi Node.js
- `npm run build` — build aset frontend (CSS + JS)

### 3. Konfigurasi database

Buka file `.env` dan sesuaikan pengaturan database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=capella_multidana
DB_USERNAME=root
DB_PASSWORD=
```

Buat database `capella_multidana` di MySQL jika belum ada:

```sql
CREATE DATABASE capella_multidana;
```

### 4. Jalankan migrasi & seed data

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan membuat tabel `pengajuan` dan mengisi 32 data dummy untuk keperluan demonstrasi.

---

## Menjalankan Aplikasi

### Development server (semua layanan sekaligus)

```bash
composer dev
```

Perintah ini menjalankan 4 layanan secara bersamaan:

| Layanan                    | Fungsi                       | Port             |
| -------------------------- | ---------------------------- | ---------------- |
| `php artisan serve`        | Web server                   | `localhost:8000` |
| `php artisan queue:listen` | Queue worker                 | —                |
| `php artisan pail`         | Log real-time                | —                |
| `npm run dev`              | Vite dev server (hot reload) | `localhost:5173` |

Buka browser dan akses: **http://localhost:8000**

### Build aset untuk produksi

```bash
npm run build
```

---

## Menjalankan Pengujian

```bash
composer test
```

Perintah ini akan:

1. Membersihkan cache konfigurasi (`config:clear`)
2. Menjalankan seluruh suite pengujian PHPUnit

### Menjalankan satu test saja

```bash
php artisan test --filter=NamaMetodeTest
```

> **Catatan:** Pengujian berjalan menggunakan database MySQL (`capella_multidana_test`). Pastikan database tersebut sudah dibuat:
>
> ```sql
> CREATE DATABASE capella_multidana_test;
> ```

---

## Struktur Proyek

```
Credit-Submission-Prototype/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # PengajuanController
│   │   └── Requests/           # StorePengajuanRequest (validasi)
│   ├── Models/                 # Pengajuan (Eloquent model)
│   └── Services/               # PengajuanService (logika bisnis)
├── database/
│   ├── factories/              # PengajuanFactory (data dummy)
│   ├── migrations/             # Schema database
│   └── seeders/                # DatabaseSeeder (32 data)
├── resources/
│   ├── css/app.css             # Token warna Material Design 3
│   ├── js/app.js               # Entry point JavaScript
│   └── views/
│       ├── layouts/app.blade.php   # Layout utama (sidebar + header)
│       ├── dashboard.blade.php     # Halaman dashboard
│   └── pengajuan/
│           ├── index.blade.php     # Daftar pengajuan + filter
│           ├── create.blade.php    # Form tambah pengajuan
│           └── show.blade.php      # Detail pengajuan
├── routes/web.php              # Definisi route
├── tests/                      # Unit & Feature tests
├── composer.json               # Dependensi PHP + script
├── package.json                # Dependensi Node.js
├── phpunit.xml                 # Konfigurasi pengujian
└── vite.config.js              # Konfigurasi Vite + Tailwind
```

---

## Aturan Bisnis

Aplikasi ini menerapkan aturan bisnis berikut:

| Aturan                         | Nilai          | Error Message                               |
| ------------------------------ | -------------- | ------------------------------------------- |
| Pendapatan bulanan minimum     | Rp 1.000.000   | Nasabah belum dapat mengajukan pinjaman     |
| Nominal pinjaman maksimum      | Rp 200.000.000 | Nominal pinjaman maksimal Rp200.000.000     |
| Tenor maksimum                 | 24 bulan       | Tenor maksimal 24 bulan                     |
| Maksimal pengajuan per nasabah | 3 kali         | Nasabah telah memiliki maksimal 3 pengajuan |

### Status pengajuan

```
pending → disetujui
pending → ditolak
```

### Tipe pinjaman

- `sepeda_motor` — Sepeda Motor
- `mobil` — Mobil
- `multiguna` — Multiguna

---

## Perintah Tersedia

| Perintah                           | Fungsi                                 |
| ---------------------------------- | -------------------------------------- |
| `composer setup`                   | Instalasi lengkap dari nol             |
| `composer dev`                     | Jalankan semua layanan development     |
| `composer test`                    | Jalankan pengujian                     |
| `npx vite build`                   | Build aset frontend                    |
| `npx laravel-pint`                 | Format kode PHP sesuai standar Laravel |
| `php artisan migrate:fresh --seed` | Reset database + isi data dummy        |

---

## License

MIT
