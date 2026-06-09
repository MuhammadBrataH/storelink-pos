PRD: Storelink POS & Inventory (Toko Fashion) 

1. Objective (Tujuan Aplikasi) 

* Mengembangkan aplikasi web Point of Sale (POS) dan Inventory Management khusus untuk toko fashion. 


* Prototipe ini bertujuan menggantikan pencatatan manual dengan menyediakan sistem yang mencatat transaksi secara otomatis, memotong stok secara real-time, dan menyajikan laporan dasar bagi pemilik usaha. 


* Versi MVP difokuskan untuk satu toko fashion sebagai pilot project, namun struktur sistem dirancang agar dapat dikembangkan ke jenis usaha lain seperti cafe atau toko perkakas di masa depan. 



---

2. User Flow (Alur Pengguna) 

2.1 Autentikasi 

* Pengguna memasukkan kredensial login. 


* Sistem memverifikasi role pengguna. 



2.2 Routing Berbasis Role 

* 
**Admin**: Diarahkan ke halaman Sapaan Utama yang menyediakan akses menuju Dashboard Analitik, Manajemen Inventory, dan Sistem POS. 


* 
**Kasir**: Diarahkan langsung ke halaman POS tanpa akses ke halaman dashboard atau manajemen inventory. 



---

3. Role & Hak Akses 

| Fitur | Admin | Kasir |
| --- | --- | --- |
| Login | Ya | Ya

 |
| Dashboard Analitik | Ya | Tidak

 |
| CRUD Produk | Ya | Tidak

 |
| Update Stok Manual | Ya | Tidak

 |
| POS / Transaksi | Ya | Ya

 |
| Print Struk | Ya | Ya

 |
| Melihat Notifikasi Stok | Ya | Tidak

 |

---

4. Data Produk Fashion 

Setiap produk fashion minimal memiliki data berikut: 

* Nama Produk 


* Kode Produk 


* Kategori Produk 


* Ukuran (S/M/L/XL) 


* Warna Produk 


* Harga Produk 


* Jumlah Stok 


* Gambar Produk (Opsional) 



---

5. Fitur Utama (MVP) 

5.1 Wajib Ada (Must Have) 

* A. Role Management (Authentication) 


* Sistem login dengan pemisahan role Admin dan Kasir. 




* B. CRUD Produk 


* Admin dapat menambah, mengedit, dan menghapus produk. 


* Admin dapat mengelola stok produk dan menambahkan variasi ukuran. 




* C. Inventory Management 


* Pengelolaan stok barang secara real-time. 


* Penyesuaian stok manual untuk barang rusak, barang hilang, retur, dan penambahan stok baru. 




* D. Transaksi POS 


* Kasir/Admin dapat memilih produk, input kode barang / barcode sederhana, menambahkan produk ke keranjang, dan mengatur *quantity* produk. 


* Kasir/Admin dapat memasukkan potongan harga dan menghitung total transaksi secara otomatis. 




* E. Simulasi Pembayaran 


* Sistem menyediakan simulasi metode pembayaran Tunai, Transfer, dan QRIS Dummy. 


* Sistem berjalan tanpa integrasi *payment gateway* pihak ketiga. 




* F. Automasi Stok 


* Stok otomatis berkurang ketika transaksi berhasil diselesaikan. 




* G. Struk Digital 


* Sistem menampilkan struk digital yang dapat dicetak menggunakan `window.print()`. 





5.2 Bagus Kalo Ada (Nice to Have) 

* A. Dashboard Analitik & Grafikal 


* Dashboard menampilkan total penjualan hari ini, jumlah transaksi hari ini, dan produk terlaris. 


* Menampilkan grafik tren penjualan harian/mingguan, estimasi profit sederhana, dan daftar stok menipis. 


* Dashboard hanya dapat diakses oleh Admin. 




* B. Notifikasi & Monitoring 


* Sistem memberikan notifikasi ketika stok barang berada di bawah batas minimum, produk hampir habis, atau terdapat stok kosong. 




* C. Filter & Pencarian 


* Sistem menyediakan pencarian nama produk, filter kategori produk, dan pencarian kode barang. 


* Fitur ini tersedia di Halaman Inventory dan Halaman POS. 




* C. Validasi & Error Handling 


* Untuk mencegah kesalahan, *quantity* produk minimal 1, stok tidak boleh minus, dan harga tidak boleh negatif. 


* Transaksi harus dikonfirmasi sebelum finalisasi, dan transaksi batal tidak mengurangi stok. 


* Produk yang stoknya habis tidak dapat ditransaksikan. 





---

6. Scope Limitation (Batasan Sistem) 

Versi MVP/prototype ini memiliki beberapa batasan: 

* Belum mendukung multi-store / multi-tenant. 


* Belum terintegrasi *payment gateway* asli. 


* Belum mendukung sinkronisasi marketplace. 


* Belum mendukung laporan akuntansi lengkap. 


* 
*Barcode scanner* masih berupa input barcode sederhana/browser input. 


* Sistem masih fokus untuk penggunaan *prototype* skala kecil-menengah. 



---

7. Struktur Database Awal (Simplified) 

Tabel Users 

| Nama Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | BigInt (Primary Key, Auto Increment) | ID unik pengguna sistem. 

 |
| `username` | Varchar(255) | Nama pengguna untuk login. 

 |
| `password` | Varchar(255) | Kata sandi yang sudah terenkripsi (hash). 

 |
| `role` | Enum('admin', 'kasir') | Penentu hak akses pengguna di dalam aplikasi. 

 |
| `timestamps` | Timestamp | Otomatis menyimpan waktu data dibuat (created_at) dan diperbarui (updated_at). 

 |

Tabel Products 

Tabel ini menyimpan data induk (master data) untuk barang-barang fashion tanpa detail spesifik ukurannya. 

| Nama Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | BigInt (Primary Key, Auto Increment) | ID unik produk fashion. 

 |
| `name` | Varchar(255) | Nama lengkap produk (contoh: Kemeja Flanel Pria). 

 |
| `category` | Varchar(100) | Kategori produk (contoh: Baju, Tas, Aksesoris). 

 |
| `description` | Text (Nullable) | Penjelasan detail mengenai produk (opsional). 

 |
| `image_url` | Varchar(255) (Nullable) | Tautan URL gambar yang diunggah ke ImgBB. 

 |
| `timestamps` | Timestamp | Otomatis menyimpan waktu data dibuat (created_at) dan diperbarui (updated_at). 

 |
| `Deleted_at` | Timestamp | Nullable. 

 |

Tabel Product_Variations 

Tabel ini menyimpan rincian spesifik dari setiap produk, sehingga perhitungan stok, ukuran, dan harga bisa berbeda meskipun nama produk utamanya sama. 

| Nama Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | BigInt (Primary Key, Auto Increment) | ID unik untuk variasi produk. 

 |
| `product_id` | BigInt (Foreign Key) | Relasi ke tabel Products (menandakan variasi ini milik produk mana). 

 |
| `size` | Varchar(50) (Nullable) | Ukuran spesifik produk (contoh: S, M, L, XL, All Size). 

 |
| `color` | Varchar(50) (Nullable) | Warna spesifik produk (contoh: Hitam, Putih, Merah). 

 |
| `price_capital` | Integer | Harga modal/pembelian awal barang (untuk menghitung profit). 

 |
| `price_sell` | Integer | Harga jual yang akan ditagihkan ke pelanggan. 

 |
| `stock` | Integer | Jumlah ketersediaan barang fisik di toko. 

 |
| `timestamps` | Timestamp | Otomatis menyimpan waktu data dibuat (created_at) dan diperbarui (updated_at). 

 |
| `Barcode` | Varchar | Nullable. 

 |
| `Deleted_at` | Timestamp | Nullable. 

 |

Tabel Transactions 

Tabel ini bertindak sebagai header faktur/struk yang mencatat ringkasan satu kejadian transaksi penuh di kasir. 

| Nama Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | BigInt (Primary Key, Auto Increment) | ID unik transaksi. 

 |
| `invoice_code` | Varchar(100) | Kode unik nota belanja (contoh: INV-0001). 

 |
| `user_id` | BigInt (Foreign Key) | Relasi ke tabel Users (mencatat siapa kasir yang memproses). 

 |
| `subtotal` | Integer | Total harga semua barang sebelum dipotong diskon. 

 |
| `discount` | Integer | Nominal potongan harga/diskon yang diinput secara manual. 

 |
| `total amount` | Integer | Total akhir yang wajib dibayar pelanggan (Subtotal dikurangi Diskon). 

 |
| `payment_method` | Enum('tunai', 'qris_dummy', 'transfer') | Pencatatan jenis pembayaran yang digunakan. 

 |
| `timestamps` | Timestamp | Otomatis mencatat waktu persis transaksi dilakukan. 

 |

Tabel Transaction_Details 

Tabel ini menyimpan daftar barang apa saja yang dimasukkan ke dalam keranjang untuk setiap transaksi (isi dari struk). 

| Nama Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | BigInt (Primary Key, Auto Increment) | ID unik untuk rincian barang. 

 |
| `transaction_id` | BigInt (Foreign Key) | Relasi ke tabel Transactions (menandakan barang ini masuk di nota yang mana). 

 |
| `variation_id` | BigInt (Foreign Key) | Relasi ke tabel Product_Variations (mencatat barang dan ukuran spesifik yang dibeli). 

 |
| `quantity` | Integer | Jumlah barang yang dibeli untuk variasi tersebut. 

 |
| `price_capital` | Integer | Rekaman harga modal pada saat transaksi (mengunci harga agar laporan laba masa lalu tidak berubah jika harga modal saat ini naik). 

 |
| `price_sell` | Integer | Rekaman harga jual pada saat transaksi. 

 |
| `timestamps` | Timestamp | Otomatis menyimpan waktu data dibuat (created_at) dan diperbarui (updated_at). 

 |

---

8. Technical Stack 

* 
**Frontend**: Laravel Blade (bawaan Laravel) + sedikit JavaScript murni (atau Alpine.js). Digunakan agar interaksi di halaman kasir bisa berjalan mulus secara *real-time* tanpa perlu *reload* halaman. 


* 
**Backend**: Laravel (PHP) untuk mengatur logika bisnis, autentikasi (login Admin/Kasir), dan perhitungan transaksi. 


* 
**Database**: MySQL untuk menangani data relasional seperti produk, variasi, dan riwayat transaksi. 


* 
**Styling**: Tailwind CSS agar tampilan tabel inventaris dan dasbor bisa terlihat modern, rapi, dan persis seperti mockup klien dengan sangat cepat. 


* 
**Deployment**: 


* 
**Aplikasi Web**: Vercel (menggunakan bantuan package `vercel-php` agar Vercel mau menjalankan project Laravel). 


* 
**Database**: Aiven (penyedia cloud database MySQL gratis yang link koneksinya akan ditanam di dalam pengaturan Vercel). 


* 
**Penyimpanan Media (Tambahan)**: ImgBB API untuk menyimpan foto produk fashion, mengingat Vercel akan langsung menghapus file gambar yang di-upload ke folder lokalnya setiap kali server restart.