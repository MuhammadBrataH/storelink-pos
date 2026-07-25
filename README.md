# 🚀 Storelink POS

![Build Status](https://img.shields.io/badge/build-passing-brightgreen?style=for-the-badge)
![Coverage](https://img.shields.io/badge/coverage-100%25-brightgreen?style=for-the-badge)
![License](https://img.shields.io/badge/license-MIT-blue?style=for-the-badge)
![Version](https://img.shields.io/badge/version-1.0.0-blue?style=for-the-badge)

> **Solusi Point of Sales (POS) modern berbasis web yang dirancang untuk mempercepat transaksi, mengelola inventori produk secara efisien, dan dilengkapi sistem otorisasi multi-role.**

Aplikasi Storelink POS dibangun dengan arsitektur MVC menggunakan Laravel, berfokus pada performa, keamanan, dan *developer experience* (DX) yang tinggi. Kami merancang sistem ini untuk memecahkan masalah pencatatan transaksi manual yang rentan error melalui antarmuka (UI/UX) yang intuitif.

<img width="959" height="514" alt="Screenshot 2026-06-14 131231" src="https://github.com/user-attachments/assets/45959fb4-b6db-4295-9b4e-e1d4c539a537" />

<img width="959" height="513" alt="Screenshot 2026-06-14 131503" src="https://github.com/user-attachments/assets/3d9dfbee-b8c8-44cf-b68e-adb24bd83f1c" />

<img width="959" height="514" alt="Screenshot 2026-06-14 131314" src="https://github.com/user-attachments/assets/e6fcf0d7-0b58-4150-adeb-0009037b0901" />


---

## 💻 Tech Stack

Sistem ini dikembangkan menggunakan teknologi modern berskala industri (*industry-standard*):

- **Backend / Framework**: [Laravel (PHP)](https://laravel.com/)
- **Frontend**: [Blade Templates](https://laravel.com/docs/blade) & HTML/CSS/JS
- **Database**: MySQL
- **Authentication**: Laravel Auth & Middleware

## ✨ Key Features

- ⚡ **Manajemen Inventori (Products)** — *Mengelola stok barang, penambahan produk baru, dan update harga secara real-time.*
- 🎨 **Sistem Transaksi Cepat** — *Mencatat detail transaksi secara akurat dan efisien untuk kebutuhan operasional kasir.*
- 🔒 **Role-Based Access Control (RBAC)** — *Pembatasan akses berbasis role secara aman (misal: antara Admin dan Staff/Kasir).*
- 📊 **Otentikasi Terpusat** — *Sistem login dan autentikasi yang aman untuk melindungi integritas data pengguna.*

## 📐 System Architecture

<img width="1167" height="889" alt="ERD" src="https://github.com/user-attachments/assets/e3165fb0-9a90-4eb9-9d23-6c21af83eadb" />


## 📌 Prerequisites

Pastikan *environment* sistem Anda telah memenuhi persyaratan berikut sebelum melakukan proses instalasi:
- **PHP 8.1+**
- **Composer** (Dependency Manager)
- **MySQL** (Berjalan di *background* melalui XAMPP/Laragon/Docker)
- **Node.js & npm** (Opsional, untuk kompilasi asset frontend)

---

## 🚀 Getting Started

Ikuti panduan instalasi langkah demi langkah berikut untuk menjalankan aplikasi Storelink POS di *environment* lokal (Development) Anda.

### 1. Clone Repository

```bash
git clone https://github.com/MuhammadBrataH/storelink-pos.git
cd storelink-pos
```

### 2. Install Dependencies

```bash
# Install dependensi backend (PHP)
composer install

# Install dependensi frontend
npm install
```

### 3. Environment Configuration

Gandakan template variabel *environment* dan sesuaikan kredensialnya dengan konfigurasi database lokal Anda.

```bash
cp .env.example .env
```

**Konfigurasi file `.env` (Sesuaikan bagian database):**
```env
APP_NAME="Storelink POS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=storelink_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database & Key

```bash
# Generate application key
php artisan key:generate

# Migrasi struktur database dan jalankan seeder (jika ada)
php artisan migrate --seed
```

### 5. Run the Application

```bash
# Menjalankan development server (Backend)
php artisan serve

# (Opsional) Menjalankan asset compiler di tab terminal baru
npm run dev
```

Aplikasi kini dapat diakses melalui browser  Anda pada `http://localhost:8000`.

---

## 💡 Usage

Setelah aplikasi berjalan, navigasikan ke URL aplikasi untuk menggunakan sistem POS.

**Alur Penggunaan Utama:**
1. Login menggunakan akun yang sudah di-seed.
2. Masuk ke halaman **Inventory** untuk melihat daftar produk.
3. Buka menu **Transaction** untuk memulai pencatatan penjualan baru dan memproses order.

## 🧪 Testing

Kami sangat peduli terhadap *code quality*. Jalankan perintah berikut untuk mengeksekusi *automated tests* dan memastikan fungsionalitas dan logika transaksi berjalan semestinya:

```bash
php artisan test
```

---

## 🤝 Contributing

Project ini berpegang pada semangat *Open Source*. Segala bentuk kolaborasi, pelaporan *bug*, maupun kontribusi fitur sangat diapresiasi! 

1. **Fork** repository ini.
2. Buat branch untuk fitur Anda: `git checkout -b feature/NamaFiturHebat`
3. **Commit** perubahan Anda: `git commit -m 'feat: Menambahkan fitur XYZ'`
4. **Push** ke branch tersebut: `git push origin feature/NamaFiturHebat`
5. Buka **Pull Request** dan deskripsikan perubahan Anda secara komprehensif.

## 📄 License

Aplikasi ini didistribusikan di bawah lisensi **MIT License**. Lihat file `LICENSE` untuk informasi lebih lanjut mengenai hak cipta.

## ✉️ Contact & Author

Dikembangkan dengan dedikasi penuh oleh **Muhammad Brata Hadinata & Wyandhanu Maulidan Nugraha**

Sebagai praktisi di bidang *Software Engineering*, kami selalu terbuka untuk diskusi teknis, kolaborasi *open source*, maupun peluang karir profesional. Mari terhubung!

- 💼 **LinkedIn**: 
https://www.linkedin.com/in/muhammad-brata-hadinata-05335b372/
https://www.linkedin.com/in/wyandhanu-nugraha-47762b32a/

- 🐙 **GitHub**: 
https://github.com/MuhammadBrataH
https://github.com/wyandhanupapoy

---
*⭐ Jangan lupa berikan star pada repository ini jika menurut Anda project ini bermanfaat!*
