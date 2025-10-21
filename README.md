# 🚀 MAVINS-POS: Modern Point of Sales Application

## Model View Product - Warung MaVins

MAVINS-POS adalah sistem Point of Sales (POS) berbasis web yang modern dan user-friendly, dibangun menggunakan **Laravel 12** dan didukung oleh antarmuka yang bersih dengan **Bootstrap 5**. [cite_start]Aplikasi ini dirancang untuk mengelola produk, kategori, dan transaksi secara efisien di lingkungan bisnis ritel[cite: 54, 115, 209].

---

## ✨ Fitur Utama (Core Features)

| Kategori           | Fitur                     | Peran Akses      | Deskripsi                                                                                                                                                                           |
| :----------------- | :------------------------ | :--------------- | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Manajemen Data** | **Product & Category**    | Admin, Manajemen | [cite_start]Mengelola seluruh daftar Produk (misalnya: Sate Ayam, Le Mineral) [cite: 121, 233, 235] [cite_start]dan Kategori Produk (Makanan, Minuman, Snack)[cite: 167, 177, 179]. |
| **Transaksi POS**  | **Interface Kasir**       | Kasir            | [cite_start]Antarmuka intuitif untuk memilih produk, mengatur kuantitas, dan melihat Keranjang Belanja[cite: 220, 223, 266].                                                        |
|                    | **Perhitungan Penjualan** | Kasir            | [cite_start]Menghitung Subtotal, Pajak (10%), Diskon, dan Total akhir secara otomatis[cite: 301, 303, 305, 306].                                                                    |
|                    | **Invoice/Struk**         | Kasir            | [cite_start]Pembuatan dan pencetakan struk transaksi instan (`/orders/{id}/invoice`)[cite: 377, 342, 354].                                                                          |
| **Laporan & Data** | **Dashboard Overview**    | Admin, Manajemen | [cite_start]Ringkasan Total Pemasukan dan Jumlah Transaksi hari ini/bulan ini[cite: 64, 84, 85, 86].                                                                                |
|                    | **Laporan Keuangan**      | Admin, Manajemen | [cite_start]Fitur _filter_ dan _export_ (misalnya PDF) untuk analisis data pemasukan berdasarkan rentang tanggal[cite: 477, 498, 500].                                              |

---

## 👥 Role-Based Access Control (RBAC)

Sistem MAVINS-POS membagi otoritas pengguna menjadi tiga peran utama untuk menjaga keamanan dan efisiensi operasional.

| Peran         | Fokus Utama                        | Akses Kritis                                                                                            |
| :------------ | :--------------------------------- | :------------------------------------------------------------------------------------------------------ |
| **Admin**     | **Konfigurasi & Pengawasan Penuh** | Akses ke semua Laporan Keuangan, Manajemen Produk & Kategori, dan Pengaturan Pengguna.                  |
| **Manajemen** | **Analisis Bisnis & Pelaporan**    | [cite_start]Akses ke Dashboard, Transaksi, dan Laporan Keuangan (Filter & Export PDF)[cite: 477].       |
| **Kasir**     | **Operasional Penjualan**          | [cite_start]Akses ke halaman Kasir/Orders untuk memproses penjualan dan mencetak struk[cite: 220, 377]. |

---

## 🛠️ Tech Stack & Tools

Aplikasi ini dibangun dengan fokus pada performa dan pemeliharaan:

<div align='center'>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" alt="JavaScript" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" alt="PHP" width="48" height="48" style="margin: 4px;" />
  
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg" alt="HTML5" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg" alt="CSS3" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg" alt="Tailwind CSS" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-plain.svg" alt="Bootstrap" width="48" height="48" style="margin: 4px;" />
  
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg" alt="Node.js" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" alt="Laravel" width="48" height="48" style="margin: 4px;" />
  
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" alt="MySQL" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-original.svg" alt="PostgreSQL" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/sqlite/sqlite-icon.svg" alt="SQLite" width="48" height="48" style="margin: 4px;" />
  
  <img src="https://www.vectorlogo.zone/logos/git-scm/git-scm-icon.svg" alt="Git" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/visualstudio_code/visualstudio_code-icon.svg" alt="VS Code" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/figma/figma-icon.svg" alt="Figma" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/getpostman/getpostman-icon.svg" alt="Postman" width="48" height="48" style="margin: 4px;" />
  <img src="https://www.vectorlogo.zone/logos/canva/canva-icon.svg" alt="Canva" width="48" height="48" style="margin: 4px;" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/illustrator/illustrator-original.svg" alt="Adobe Illustrator" width="48" height="48" style="margin: 4px;" />
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
    [cite_start]Aplikasi akan berjalan di `http://127.0.0.1:8000/login`[cite: 11, 43].

---

## 👨‍💻 Kontributor

| Nama                       | Peran                | GitHub                                                          |
| :------------------------- | :------------------- | :-------------------------------------------------------------- |
| **Kevin Adisurya Nugraha** | Full-Stack Developer | [kevinadisuryanugraha](https://github.com/kevinadisuryanugraha) |
