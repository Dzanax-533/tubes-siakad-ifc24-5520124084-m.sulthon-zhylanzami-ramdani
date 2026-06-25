# SIAKAD - Sistem Informasi Akademik

SIAKAD adalah aplikasi manajemen akademik berbasis Laravel yang dirancang untuk mempermudah administrasi kampus. Proyek ini menggabungkan manajemen data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi (KRS) dalam satu platform.

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo">
</p>

## Ringkasan Proyek

Aplikasi SIAKAD mendukung dua peran utama:

- **Admin**: mengelola master data akademik dan jadwal kuliah.
- **Mahasiswa**: memilih mata kuliah KRS, memonitor jadwal, dan melihat ringkasan SKS.

## Fitur Utama

- Autentikasi lengkap: registrasi, login, dan verifikasi email.
- Dashboard berbeda untuk `admin` dan `mahasiswa`.
- CRUD master data untuk Dosen, Mahasiswa, Mata Kuliah, dan Jadwal.
- Sistem KRS mahasiswa dengan validasi lebih baik dan batas 24 SKS.
- Relasi data otomatis antara dosen, mahasiswa, mata kuliah, dan jadwal.
- Middleware role-based untuk memisahkan akses administrator dan mahasiswa.

## Modul & Halaman Utama

| Halaman | Fungsi |
| --- | --- |
| `/` | Landing page default Laravel.
| `/dashboard` | Redirect ke dashboard sesuai peran.
| `/profile` | Pengaturan profil pengguna.
| `/admin/dosen` | Manajemen data dosen.
| `/admin/mahasiswa` | Manajemen data mahasiswa.
| `/admin/matakuliah` | Manajemen data mata kuliah.
| `/admin/jadwal` | Manajemen jadwal perkuliahan.
| `/mahasiswa/dashboard` | Panel KRS mahasiswa.

## Teknologi Utama

- PHP 8.3
- Laravel 13.x
- Laravel Breeze untuk autentikasi
- Blade template engine
- Vite untuk build asset
- MySQL / SQLite / PostgreSQL sebagai database

## Struktur Aplikasi

- `app/Http/Controllers/` - logika untuk setiap modul.
- `app/Models/` - model data utama: `Dosen`, `Mahasiswa`, `Matakuliah`, `Jadwal`, `User`.
- `resources/views/` - antarmuka pengguna untuk admin dan mahasiswa.
- `routes/web.php` - definisi rute aplikasi.
- `database/migrations/` - skema tabel dan relasi.

## Instalasi & Jalankan

1. Salin `.env.example` menjadi `.env`.
2. Jalankan `composer install`.
3. Jalankan `npm install`.
4. Jalankan `php artisan key:generate`.
5. Sesuaikan konfigurasi database di `.env`.
6. Jalankan `php artisan migrate`.
7. Jalankan `php artisan serve`.

### Perintah Pendukung

```bash
npm run dev
npm run build
php artisan migrate:fresh --seed
php artisan test
```

## Catatan Penting

- Pastikan data akun mahasiswa sudah sesuai dengan data master mahasiswa untuk sinkronisasi dashboard.
- Batas pengambilan KRS adalah 24 SKS.
- Admin harus mendaftarkan data mahasiswa dengan nama yang sama persis seperti yang digunakan di akun login.

## Lisensi

Proyek ini menggunakan lisensi MIT.
