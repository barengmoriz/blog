## Laravel Blog

Belajar membuat Blog menggunakan Laravel.

## Kebutuhan

-   PHP >= 8.2
-   Composer
-   NodeJS

## Fitur

### 1. Kategori

-   Tambah Data Kategori
-   Edit Data Kategori
-   Hapus Data Kategori

### 2. Tag

-   Tambah Data Tag
-   Edit Data Tag
-   Hapus Data Tag

### 3. Blog

-   Tambah Data Blog
-   Edit Data Blog
-   Hapus Data Blog
-   Tayang Blog

### 4. Pengguna

-   Tambah Data Pengguna
-   Edit Data Pengguna
-   Hapus Data Pengguna
-   Verifikasi Email
-   Foto Profil

### 5. Peran

-   Tambah Data Peran
-   Edit Data Peran
-   Hapus Data Peran

### 6. Hak Akses

-   Tambah Data Hak Akses
-   Edit Data Hak Akses
-   Hapus Data Hak Akses

## Perbarui Aplikasi

Catatan : Jika sudah melakukan unduh dan atur aplikasi, bisa langsung perbarui aplikasi saja tanpa instal dari awal.

Lakukan perintah berikut pada aplikasi yang sudah ada

```bash
git pull
composer install
npm install
php artisan migrate
php artisan app:generate-username
```

Lakukan perintah berikut untuk mengisi data peran dan hak akses secara otomatis
Catatan : jika dijalankan ulang, maka data peran dan hak akses akan disetel ulang ke data awal.

```
php artisan db:seed
```

Lakukan perintah berikut untuk memberikan peran Super Admin pada pengguna

```
php artisan app:set-superadmin
```

Kamu juga bisa lakukan perintah berikut, ubah `nama_pengguna` dengan nama pengguna yang akan dijadikan sebagai Super Admin

```
php artisan app:set-superadmin nama_pengguna
```

Konfigurasi file .env

```
APP_LOCALE=id
FILESYSTEM_DISK=public
API_KEY_TINYMCE="isiapikeytinymcekamu"

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username_mailtrap
MAIL_PASSWORD=password_mailtrap
```

## Instalasi Aplikasi

### Unduh aplikasi

```bash
git clone https://github.com/barengmoriz/blog.git
```

Catatan: Jika kalian menggunakan Laravel Herd, lakukan `git clone` pada `Herd paths` yang telah kalian atur.

### Instal paket php dan nodejs

```bash
cd blog
composer install
npm install
```

### Salin file `.env.example` dan ubah nama menjadi `.env`

```bash
cp .env.example .env
```

### Membuat kunci aplikasi

```bash
php artisan key:generate
```

### Sesuaikan data & database pada file .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=

APP_LOCALE=id
FILESYSTEM_DISK=public
API_KEY_TINYMCE="isiapikeytinymcekamu"

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username_mailtrap
MAIL_PASSWORD=password_mailtrap
```

Sesuaikan konfigurasi pada `.env` sesuai kebutuhan

Lakukan perintah berikut untuk mengisi data peran dan hak akses secara otomatis
Catatan : jika dijalankan ulang, maka data peran dan hak akses akan disetel ulang ke data awal.

```
php artisan db:seed
```

Lakukan perintah berikut untuk memberikan peran Super Admin pada pengguna

```
php artisan app:set-superadmin
```

Kamu juga bisa lakukan perintah berikut, ubah `nama_pengguna` dengan nama pengguna yang akan dijadikan sebagai Super Admin

```
php artisan app:set-superadmin nama_pengguna
```

### Menjalankan storage link

```bash
php artisan storage:link
```

### Menjalankan migrasi database

```bash
php artisan migrate
```

### Menjalankan aplikasi

```bash
php artisan serve
```

Catatan : abaikan perintah di atas jika kalian menggunakan Laravel Herd, bisa langsung buka di browser http://blog.test

### Menjalankan auto refresh / hot reload

```bash
npm run dev
```

## Tautan Pendukung

-   Laravel : https://laravel.com
-   TailwindCSS : https://tailwindcss.com
-   TinyMCE : https://www.tiny.cloud
-   Avatar : https://github.com/laravolt/avatar
-   Mailtrap : https://mailtrap.io
-   SweetAlert : https://sweetalert2.github.io
-   Select2 : https://select2.org
-   FakeData : https://www.fakedata.pro
-   Laravel Permission : https://spatie.be/docs/laravel-permission/v6
