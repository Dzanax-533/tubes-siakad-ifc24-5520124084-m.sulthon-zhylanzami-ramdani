# SIAKAD - Sistem Informasi Akademik

SIAKAD adalah aplikasi manajemen akademik sederhana berbasis Laravel untuk mengelola data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi (KRS).

## Deskripsi Singkat

Aplikasi ini menyediakan dua alur pengguna utama:
- **Admin**: Mengelola master data dosen, mahasiswa, mata kuliah, dan jadwal kuliah.
- **Mahasiswa**: Mengakses dashboard akademik, melihat jadwal tersedia, mengambil dan membatalkan mata kuliah pada KRS.

Sistem menggunakan autentikasi Laravel standar dengan pendaftaran, login, verifikasi email, dan profil pengguna.

## Fitur Utama

### 1. Autentikasi dan Profil
- Login dan pendaftaran pengguna menggunakan fitur Laravel Breeze.
- Verifikasi email dan proteksi rute untuk akses terbatas.
- Halaman profil yang memungkinkan pengguna memperbarui data akun.

### 2. Dashboard Admin
- Dashboard utama menampilkan tautan cepat ke modul manajemen data.
- Menu navigasi admin meliputi:
  - `Master Dosen`
  - `Master Mahasiswa`
  - `Master Mata Kuliah`
  - `Jadwal Kuliah`

### 3. Master Dosen
- Menambahkan, mengubah, dan menghapus data dosen.
- Validasi NIDN (10 digit) dan nama dosen.
- Data dosen digunakan sebagai wali mahasiswa dan pengajar jadwal kuliah.

### 4. Master Mahasiswa
- Menambahkan, mengubah, dan menghapus data mahasiswa.
- Mengaitkan mahasiswa ke dosen wali.
- Data disimpan dengan NPM dan nama lengkap mahasiswa.

### 5. Master Mata Kuliah
- Menambahkan, mengubah, dan menghapus mata kuliah.
- Menyimpan kode mata kuliah, nama mata kuliah, dan bobot SKS.
- Perubahan mata kuliah memengaruhi jadwal dan KRS mahasiswa.

### 6. Manajemen Jadwal Kuliah
- Menambahkan dan menghapus jadwal perkuliahan.
- Mengatur relasi antara mata kuliah, dosen, kelas, hari, dan jam.
- Jadwal aktif ditampilkan untuk mahasiswa saat memilih KRS.

### 7. Dashboard Mahasiswa
- Menampilkan informasi mahasiswa, wali, dan status KRS.
- Memperlihatkan jadwal perkuliahan yang tersedia.
- Menampilkan daftar mata kuliah yang sudah diambil beserta jumlah SKS.
- Memungkinkan mahasiswa menambah atau membatalkan mata kuliah KRS.
- Proteksi beban studi maksimal 24 SKS saat mengambil KRS.

### 8. Halaman KRS Mahasiswa
- Form pilihan jadwal kuliah pada dashboard mahasiswa.
- Validasi agar mahasiswa tidak mengambil jadwal yang sama dua kali.
- Fitur batal KRS untuk menghapus mata kuliah dari rencana studi.

## Struktur Halaman

- `/` : Halaman sambutan Laravel (`welcome`).
- `/dashboard` : Redirect ke dashboard admin atau mahasiswa berdasarkan peran.
- `/profile` : Halaman pengaturan profil pengguna.
- `/admin/dosen` : Manajemen data dosen.
- `/admin/mahasiswa` : Manajemen data mahasiswa.
- `/admin/matakuliah` : Manajemen data mata kuliah.
- `/admin/jadwal` : Manajemen jadwal kuliah.
- `/mahasiswa/dashboard` : Halaman utama mahasiswa untuk KRS dan jadwal.

## Catatan Teknis

- User role dikendalikan oleh atribut `role` pada model `User`.
- Middleware `IsAdmin` dan `IsMahasiswa` memastikan akses halaman sesuai peran.
- Relasi model utama:
  - `Dosen` memiliki `Mahasiswa` dan `Jadwal`.
  - `Matakuliah` memiliki `Jadwal` dan relasi many-to-many dengan `Mahasiswa` melalui tabel `krs`.
  - `KRS` menyimpan pilihan mata kuliah mahasiswa.

## Cara Menjalankan

1. Salin file `.env.example` menjadi `.env`.
2. Jalankan `composer install` dan `npm install`.
3. Jalankan `php artisan key:generate`.
4. Konfigurasi database di `.env` dan jalankan `php artisan migrate`.
5. Jalankan server dengan `php artisan serve`.

## Bahasa

Dokumentasi ini ditulis dalam bahasa Indonesia untuk mencerminkan nama fitur dan pesan pengguna dalam aplikasi.
