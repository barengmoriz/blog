## Laravel Blog

Belajar membuat Blog menggunakan Laravel.

## Kebutuhan

-   PHP >= 8.2
-   Composer
-   NodeJS

## Update Aplikasi

Catatan : Jika sudah melakukan download dan setting aplikasi, bisa langsung update project saja tanpa instal dari awal.

Lakukan perintah berikut pada aplikasi yang sudah ada

```bash
git pull
composer install
npm install
php artisan migrate
```

Setting file .env

```
APP_LOCALE=id
FILESYSTEM_DISK=public
API_KEY_TINYMCE="isiapikeytinymcekamu"
```

## Instalasi Aplikasi

### Download source code

```bash
git clone https://github.com/barengmoriz/blog.git
```

Catatan: Jika kalian menggunakan Laravel Herd, lakukan `git clone` pada `Herd paths` yang telah kalian setting.

### Instal package

```bash
cd blog
composer install
npm install
```

### Salin file `.env.example` dan ubah nama menjadi `.env`

```bash
cp .env.example .env
```

### Generate key

```bash
php artisan key:generate
```

### Setting data & database pada file .env

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

### Menjalankan auto reload / refresh

```bash
npm run dev
```
