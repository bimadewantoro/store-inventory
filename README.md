<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Store Inventory
Store Inventory adalah aplikasi web untuk mengelola inventaris toko yang dikembangkan menggunakan Laravel dan Filament.

## Requirements
- PHP 8.1 atau lebih baru
- Composer
- MySQL atau MariaDB

## Installation
1. Clone repository ini
``` bash
git clone https://github.com/bimadewantoro/store-inventory.git
cd store-inventory
```
2. Install dependencies
``` bash
composer install
```
3. Copy file `.env.example` menjadi `.env`
``` bash
cp .env.example .env
```

4. Generate key aplikasi
``` bash
php artisan key:generate
```

5. Buat database baru di MySQL atau MariaDB
6. Konfigurasi database di file `.env`
``` env
DB_CONNECTION=mysql
DB_HOST=YOUR_DB_HOST
DB_PORT=YOUR_DB_PORT
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD
```
7. Migrasi database
``` bash
php artisan migrate
```
8. Jalankan aplikasi
``` bash
php artisan serve
```
