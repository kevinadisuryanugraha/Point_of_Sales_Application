# 🚀 MAVINS-POS: Modern Point of Sales Application

## Model View Product - Warung MaVins

MAVINS-POS adalah sistem Point of Sales (POS) berbasis web yang modern dan user-friendly, dibangun menggunakan **Laravel 12** dan didukung oleh antarmuka yang bersih dengan **Bootstrap 5**. Aplikasi ini dirancang untuk mengelola produk, kategori, dan transaksi secara efisien di lingkungan bisnis ritel.

---

## ✨ Fitur Utama (Core Features)

| Kategori           | Fitur                     | Peran Akses      | Deskripsi                                                                                                                              |
| :----------------- | :------------------------ | :--------------- | :------------------------------------------------------------------------------------------------------------------------------------- |
| **Manajemen Data** | **Product & Category**    | Admin, Manajemen | Mengelola seluruh daftar Produk (misalnya: Sate Ayam, Le Mineral) [cite: 121, 233, 235] dan Kategori Produk (Makanan, Minuman, Snack). |
| **Transaksi POS**  | **Interface Kasir**       | Kasir            | Antarmuka intuitif untuk memilih produk, mengatur kuantitas, dan melihat Keranjang Belanja.                                            |
|                    | **Perhitungan Penjualan** | Kasir            | Menghitung Subtotal, Pajak (10%), Diskon, dan Total akhir secara otomatis.                                                             |
|                    | **Invoice/Struk**         | Kasir            | Pembuatan dan pencetakan struk transaksi instan (`/orders/{id}/invoice`).                                                              |
| **Laporan & Data** | **Dashboard Overview**    | Admin, Manajemen | Ringkasan Total Pemasukan dan Jumlah Transaksi hari ini/bulan ini.                                                                     |
|                    | **Laporan Keuangan**      | Admin, Manajemen | Fitur _filter_ dan _export_ (misalnya PDF) untuk analisis data pemasukan berdasarkan rentang tanggal.                                  |

---

## 👥 Role-Based Access Control (RBAC)

Sistem MAVINS-POS membagi otoritas pengguna menjadi tiga peran utama untuk menjaga keamanan dan efisiensi operasional.

| Peran         | Fokus Utama                        | Akses Kritis                                                                           |
| :------------ | :--------------------------------- | :------------------------------------------------------------------------------------- |
| **Admin**     | **Konfigurasi & Pengawasan Penuh** | Akses ke semua Laporan Keuangan, Manajemen Produk & Kategori, dan Pengaturan Pengguna. |
| **Manajemen** | **Analisis Bisnis & Pelaporan**    | Akses ke Dashboard, Transaksi, dan Laporan Keuangan (Filter & Export PDF).             |
| **Kasir**     | **Operasional Penjualan**          | Akses ke halaman Kasir/Orders untuk memproses penjualan dan mencetak struk.            |

---

## 🛠️ Tech Stack & Tools

Aplikasi ini dibangun dengan fokus pada performa dan pemeliharaan:

<div align='center'>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" alt="JavaScript" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" alt="PHP" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg" alt="HTML5" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg" alt="CSS3" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-plain.svg" alt="Bootstrap" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" alt="Laravel" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" alt="MySQL" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/git-scm/git-scm-icon.svg" alt="Git" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/visualstudio_code/visualstudio_code-icon.svg" alt="VS Code" width="48" height="48" style="margin: 4px;" />
</div>

---

## ⚙️ Instalasi Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek secara lokal:

1.  **Clone Repositori:**

    ```bash
    git clone [https://github.com/kevinadisuryanugraha/mvp-pos.git](https://github.com/kevinadisuryanugraha/mvp-pos.git)
    cd mvp-pos
    ```

2.  **Instal Dependensi PHP (Composer):**

    ```bash
    composer install
    ```

3.  **Konfigurasi Lingkungan:**

    -   Duplikat file `.env.example` menjadi `.env`.
    -   Atur kunci aplikasi:
        ```bash
        php artisan key:generate
        ```

4.  **Konfigurasi Database:**

    -   Buat database baru (misalnya, `mvp_pos`).
    -   Perbarui kredensial database di file `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5.  **Jalankan Migrasi & Seeder:**

    ```bash
    php artisan migrate --seed
    ```

    _(Gunakan perintah ini untuk membuat tabel dan mengisi data awal, termasuk akun admin.)_

6.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000/login`.

---

## 📸 Dokumentasi (Screenshots)

_Untuk melihat antarmuka pengguna secara langsung, silakan lihat tangkapan layar di bawah ini._

### 1. Halaman Login

![Login Page](https://raw.githubusercontent.com/kevinadisuryanugraha/Point_of_Sales_Application/main/readme_asset/login.png)
<br/>

### 2. Dashboard Admin

![Dashboard Admin](https://raw.githubusercontent.com/kevinadisuryanugraha/Point_of_Sales_Application/main/readme_asset/dashboard.png)
<br/>

### 3. Interface Kasir (Point of Sales)

![Kasir Interface](https://raw.githubusercontent.com/kevinadisuryanugraha/Point_of_Sales_Application/main/readme_asset/kasir.png)
<br/>

### 4. Manajemen Produk

![Product Management](https://raw.githubusercontent.com/kevinadisuryanugraha/Point_of_Sales_Application/main/readme_asset/produk.png)
<br/>

### 5. Laporan Keuangan

![Financial Report](https://raw.githubusercontent.com/kevinadisuryanugraha/Point_of_Sales_Application/main/readme_asset/laporan_keuangan.png)

---

---

## 👨‍💻 Kontributor

| Nama                       | Peran                | GitHub                                                          |
| :------------------------- | :------------------- | :-------------------------------------------------------------- |
| **Kevin Adisurya Nugraha** | Full-Stack Developer | [kevinadisuryanugraha](https://github.com/kevinadisuryanugraha) |
