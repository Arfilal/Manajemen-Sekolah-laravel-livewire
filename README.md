# 📚 Manajemen Sekolah - Laravel Livewire

Aplikasi **Manajemen Sekolah** berbasis **Laravel 10 + Livewire 3**, yang memudahkan pengelolaan data **Guru**, **Siswa**, dan **Kelas** secara **dinamis**, **real-time**, dan dengan **fitur CRUD lengkap**.

---

## ✅ Fitur Utama
- **Manajemen Guru**
  - Tambah, Edit, Hapus data guru
  - Hubungkan guru dengan kelas
- **Manajemen Siswa**
  - Tambah, Edit, Hapus data siswa
  - Pilih kelas untuk siswa
- **Manajemen Kelas**
  - Tambah, Edit, Hapus data kelas
  - **Lihat daftar guru** di setiap kelas
- **Pencarian & Sortir**
  - Cari data guru, siswa, atau kelas secara real-time
- **Pagination**
  - Tabel data dengan pagination otomatis (Bootstrap style)
- **Responsive UI** berbasis **Bootstrap**

---

## 🛠️ Teknologi yang Digunakan
- **PHP 8+**
- **Laravel 10**
- **Laravel Livewire 3**
- **Bootstrap 5**
- **MySQL**

---

## 📂 Struktur Folder Penting
```plaintext
app/
└── Livewire/
    ├── Guru/
    │   └── GuruComponent.php
    ├── Siswa/
    │   └── SiswaComponent.php
    └── Kelas/
        └── KelasComponent.php

resources/
└── views/
    └── livewire/
        ├── guru/
        │   └── guru-component.blade.php
        ├── siswa/
        │   └── siswa-component.blade.php
        └── kelas/
            └── kelas-component.blade.php
```

## ⚙️ Langkah 1: Clone Repository
- git clone https://github.com/username/nama-repo.git
- cd nama-repo


## ⚙️ Langkah 2: Install Dependencies
- composer install
- npm install
- npm run dev

## ⚙️ Langkah 3: Konfigurasi Environment
- cp .env.example .env
- **Kemudian konfigurasi database:**
    - DB_DATABASE=nama_database
    - DB_USERNAME=root
    - DB_PASSWORD=

## ⚙️ Langkah 4: Migrasi & Seeder
- php artisan migrate
- php artisan db:seed

## ⚙️ Langkah 5: Jalankan Server
- php artisan serve
- **Aplikasi akan berjalan di:**
    -http://127.0.0.1:8000

## 🔍 Penjelasan Bagian Livewire
- **1. GuruComponent.php**
- Fungsi: Mengelola data guru (CRUD + search + sort).

- Relasi: Mengambil nama_kelas dari tabel kelas.

- Metode penting:
    -store() → Tambah guru baru.

    - edit() → Ambil data guru untuk diedit.

    - update() → Simpan perubahan.

    - delete() → Hapus guru.

    - resetForm() → Reset form input.

- **2. SiswaComponent.php**
- Fungsi: Mengelola data siswa (CRUD) dengan relasi ke kelas.

- Metode penting: Sama seperti Guru (CRUD, search, pagination).

 - **3. KelasComponent.php**
 - Fungsi: Mengelola data kelas (CRUD).

 - Tambahan: Tombol "Lihat Guru" di tabel kelas untuk menampilkan guru di kelas tersebut.

    





