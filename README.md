# KomikKami - Sistem Baca Komik Digital Berbasis Web
**Developer** : Muhammad Taufik Budiman

**KomikKami** merupakan platform baca komik tersentralisasi berbasis web dengan manajemen gambar per chapter yang terstruktur. Sistem ini dibangun untuk memberikan pengalaman membaca yang optimal dengan mengatasi masalah umum seperti waktu muat yang lambat, pop-up iklan yang intrusif, serta kesulitan pelacakan riwayat baca antar perangkat. Menggunakan antarmuka scroll vertikal (webtoon style) yang mulus, sistem menyajikan gambar melalui teknik *lazy loading* agar ringan diakses, baik melalui desktop maupun perangkat mobile. Sistem ini dikembangkan dengan arsitektur **MVC (Model-View-Controller)** menggunakan PHP.

## Fitur Utama

### Frontend (User)
* **Mode Baca Seamless:** Pengalaman membaca dengan antarmuka scroll vertikal (tanpa halaman freeze) dan implementasi teknik *lazy loading*.
* **Daftar Komik:** Menampilkan daftar komik dengan detail status (Ongoing & Completed).
* **Halaman Detail:** Menampilkan informasi lengkap komik termasuk Sinopsis, Genre, Author, Artist, Publisher, Tahun Rilis, dan Daftar Chapter.
* **Autentikasi:** Sistem Login dan Register untuk pengguna agar dapat masuk ke dalam sistem.

### Backend (Admin Dashboard)
* **Manajemen Data Komik:** Sistem CRUD (Create, Read, Update, Delete) komik baru lengkap dengan detail metadata dan cover.
* **Manajemen Chapter Berbasis ZIP:** Upload chapter baru dengan mudah hanya dengan mengunggah satu file arsip (`.zip`) yang berisi urutan gambar (01.jpg, 02.jpg, dst). Sistem akan secara otomatis mengekstrak dan menyimpannya ke dalam direktori path yang terstruktur.
* **Manajemen Pengguna:** Melihat daftar pengguna yang terdaftar, menambahkan user/admin baru, serta menghapus akun dan mengatur hak akses (Role).

---

## Struktur Direktori 
Sistem ini menggunakan arsitektur MVC yang terstruktur rapi. Berikut adalah penjelasan isi file dan direktorinya:

* **`app/controllers/`** *(Mengatur alur kontrol sistem)*
    * `ChapterController.php`: Menangani logika untuk upload, list, dan menghapus chapter, termasuk fungsionalitas ekstrak file `.zip` chapter.
    * `KomikController.php`: Mengelola logika CRUD komik di sisi admin serta penyajian data komik di halaman utama dan detail untuk pengunjung.
    * `UserController.php`: Menangani proses autentikasi (login, pendaftaran) dan pengaturan akun pengguna oleh admin.
* **`app/models/`** *(Berinteraksi langsung dengan Database)*
    * `ChapterModel.php`: Eksekusi query untuk tabel `chapters` (menyimpan urutan dan *path folder* gambar).
    * `KomikModel.php`: Eksekusi query untuk tabel `komik` (menyimpan atribut metadata komik).
    * `UserModel.php`: Eksekusi query untuk keamanan, validasi, dan kelola data di tabel `users`.
* **`app/views/`** *(Antarmuka Pengguna/UI)*
    * `admin/`: Memuat halaman backend seperti `komik_list.php`, `komik_add.php`, `chapter_list.php`, dan form penambahan data.
    * `auth/`: Memuat halaman sistem masuk dan kelola akun seperti `login.php`, `register.php`, `list_users.php`, dan form manipulasi user.
    * `frontend/`: Memuat antarmuka depan publik seperti `home.php`, `detail.php` komik, dan `read_chapter.php`.
* **`public/`**
    * `index.php`: *Entry point* utama aplikasi yang me-routing semua request URL ke controller yang tepat.
* **`config/`** & **`img/`**
    * Direktori untuk menyimpan file konfigurasi utama (seperti koneksi DB) dan folder aset gambar (cover komik, direktori hasil ekstrak chapter).

---

## Database
Database bernama **`komikkami`** dirancang secara relasional dengan 3 tabel utama:
* **`users`**: Tabel untuk autentikasi yang menyimpan `id_users`, `username`, `password` (terenkripsi *hash*), dan `role` (hak akses terbagi sebagai 'admin' atau 'user').
* **`komik`**: Tabel yang menyimpan data setiap komik (id, judul, sinopsis, genre, author, artist, publisher, tahun rilis, status, dan nama file gambar cover).
* **`chapters`**: Tabel yang Menyimpan urutan nomor chapter, judul spesifik bab, serta letak path dari gambar/halaman (*content_path*) berdasarkan komiknya.

---

## Installation & Setup

Ikuti langkah-langkah berikut untuk menginstall dan menjalankan aplikasi di komputer/server lokal (localhost):

1.  **Clone atau Download** repository ini ke dalam direktori server lokal Anda (misalnya ke `C:/xampp/htdocs/komikkami` jika Anda menggunakan XAMPP).
2.  **Jalankan Web Server dan MySQL** (Apache & MySQL pada XAMPP Control Panel).
3.  **Setup Database:**
    * Buka peramban (browser) dan akses `http://localhost/phpmyadmin/`.
    * Buat database baru bernama `komikkami`.
    * Pilih menu **Import**, lalu unggah file `komikkami.sql` yang disertakan di dalam repository ini. Klik **Go** / **Import**.
4.  **Konfigurasi Koneksi:**
    * Masuk ke folder `config/` dan pastikan kredensial koneksi *database* (seperti root dan password kosong) sudah disesuaikan dengan konfigurasi server database lokal Anda.
5.  **Jalankan Aplikasi:**
    * Buka browser dan akses URL: `http://localhost/komikkami/public/` (sesuaikan URL dengan letak folder Anda).
6.  **Akses Admin:**
    * Gunakan akun admin default (dari data instalasi SQL) untuk mengakses dashboard dengan Role Admin. Anda juga dapat mendaftar akun baru lalu mengubah rolenya langsung dari phpMyAdmin bila diperlukan.
