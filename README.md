## Laravel Blog

Belajar membuat Blog menggunakan Laravel

## Kebutuhan

-   PHP >= 8.2
-   Composer
-   NodeJS

## Instalasi Aplikasi

### Download Source Code

```bash
git clone https://github.com/barengmoriz/blog.git
```

### Instal Package

```bash
cd blog
composer install
npm install
```

### Salin file .env

```bash
cp .env.example .env
```

### Generate Key

```bash
php artisan key:generate
```

### Setting Data & Database Pada File .env

```
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan data pada `.env` sesuai kebutuhan

### Menjalankan Aplikasi

```bash
php artisan serve
```

Abaikan perintah di atas jika kalian menggunakan Laravel Herd, bisa langsung buka di browser http://blog.test

### Auto Reload

```bash
npm run dev
```
