## Laravel Blog

Belajar membuat Blog menggunakan Laravel.

## Kebutuhan

-   PHP >= 8.2
-   Composer
-   NodeJS

## Fitur

-   CRUD Kategori
-   CRUD Tag
-   CRUD Blog

## Perbarui Aplikasi

Catatan : Jika sudah melakukan download dan setting aplikasi, bisa langsung update project saja tanpa instal dari awal.

Lakukan perintah berikut pada aplikasi yang sudah ada

```bash
git pull
composer install
npm install
php artisan migrate
php artisan app:generate-username
```

Setting file .env

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

### Unduh source code

```bash
git clone https://github.com/barengmoriz/blog.git
```

Catatan: Jika kalian menggunakan Laravel Herd, lakukan `git clone` pada `Herd paths` yang telah kalian setting.

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

Sesuaikan data pada `.env` sesuai kebutuhan

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
-   Mailtrap : https://mailtrap.io
-   SweetAlert : https://sweetalert2.github.io
-   Select2 : https://select2.org
