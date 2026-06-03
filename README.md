# Event Ticketing Management System (ETMS)

Platform penjualan tiket event (konsep mirip Loket.com) — Laravel 13 + MySQL + Tailwind CSS.

## Tahap pengembangan

| Tahap | Status | Isi |
|-------|--------|-----|
| **1** | Selesai | Auth 4 role, middleware, layout dashboard, admin kelola user |
| 2 | Rencana | Event, kategori, jenis tiket (creator + admin) |
| 3 | Rencana | Halaman publik, checkout, order, pembayaran manual |
| 4 | Rencana | Generate tiket, QR Code, e-ticket |
| 5 | Rencana | Scan QR, anti double-scan |
| 6 | Rencana | Statistik, laporan, export |

Dokumentasi arsitektur: [docs/ARCHITECTURE.md](docs/ARCHITECTURE.md)

## Persyaratan

- PHP 8.3+
- Composer 2
- MySQL 8+ (disarankan) atau SQLite untuk uji cepat
- Node.js 20+ (opsional, untuk `npm run build`)

## Setup MySQL

```sql
CREATE DATABASE event_ticketing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

```bash
git clone https://github.com/digitvnewsid-rgb/dtixbydgentertainment.git
cd dtixbydgentertainment
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_ticketing
DB_USERNAME=root
DB_PASSWORD=your_password
```

```bash
php artisan migrate --seed
php artisan serve
```

Buka http://127.0.0.1:8000

## Akun demo (password: `password`)

| Role | Email |
|------|--------|
| Administrator | admin@etms.test |
| Creator | creator@etms.test |
| Customer | customer@etms.test |
| Ticketing | ticketing@etms.test |

Customer baru dapat **register** di `/register`.

## Route penting (Tahap 1)

| URL | Role |
|-----|------|
| `/` | Public homepage |
| `/login` | Semua role |
| `/register` | Customer |
| `/admin/dashboard` | Administrator |
| `/admin/users` | Administrator — CRUD user |
| `/creator/dashboard` | Creator |
| `/customer/dashboard` | Customer |
| `/ticketing/dashboard` | Ticketing |

## Tes

```bash
php artisan test
```

## Struktur role & middleware

Middleware `role:administrator` (atau `creator`, `customer`, `ticketing`) membatasi akses per prefix route. User nonaktif tidak bisa login.
