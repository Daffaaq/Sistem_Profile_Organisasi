# Sekilas Tentang Sistem ini 

Sistem yang menunjang Admin Organisasi dan Perusahaan untuk manajemen Article, galeri, File, dan Aspiration.
Cocok untuk Mahasiswa yang mau belajar CRUD Laravel 

## Instalasi

Instruksi untuk menginstal dan menjalankan proyek:

1. Pastikan Anda memiliki [Composer](https://getcomposer.org/) dan [Node.js](https://nodejs.org/) terinstal di komputer Anda.
2. Clone repositori ini ke komputer Anda:

    ```bash
    git clone https://github.com/Daffaaq/Sistem_Profile_Organisasi.git
    ```

3. Masuk ke direktori proyek:

    ```bash
    cd nama-proyek
    ```

4. Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

5. Generate kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

6. Install dependensi PHP menggunakan Composer:

    ```bash
    composer install
    ```

7. Install dependensi JavaScript menggunakan npm (atau yarn jika Anda menggunakannya):

    ```bash
    npm install
    ```

8. Jalankan migrasi database untuk membuat skema tabel:

    ```bash
    php artisan migrate
    ```
    ATAU
    ```bash
    php artisan migrate:fresh --seed
    ```
    

9. Jalankan server pengembangan Laravel:

    ```bash
    php artisan serve
    ```

10. Buka browser web dan akses aplikasi di `http://localhost:8000`.

## Penggunaan

### Fitur

- ✅ Login 2 Role Superadmin dan Admin
- ✅ CRUD Category Articles
- ✅ CRUD Category Galery
- ✅ CRUD Category Aspiration
- ✅ CRUD Category File

- ✅ CRUD Articles
- ❌ CRUD Galery (belum dikerjakan)
- ✅ CRUD File 
- ❌ CRUD User (belum dikerjakan)

NB: Landing Page Login Bawaan Laravel
Not Register



## Admin Template

https://startbootstrap.com/theme/sb-admin-2


