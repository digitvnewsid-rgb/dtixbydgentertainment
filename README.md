# DTIX BYDG Entertainment

Sistem manajemen tiket hiburan (Laravel) — panel admin untuk kategori event, lokasi venue, dan acara.

## Modul

| Modul | Route prefix | Keterangan |
|-------|----------------|------------|
| Auth Admin | `admin/login` | Login khusus role `admin` |
| Dashboard | `admin/dashboard` | Ringkasan statistik |
| Kategori Event | `admin/categories` | CRUD kategori |
| Lokasi Venue | `admin/venues` | CRUD venue |
| Acara | `admin/events` | CRUD acara (relasi kategori + venue) |

Modul berikutnya yang direncanakan: **Tipe Tiket** (CRUD per acara) dan **Pemesanan**.

## Setup

```bash
composer install
cp .env.example .env   # jika belum ada
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Buka http://127.0.0.1:8000/admin/login

**Admin demo:** `admin@dtix.test` / `password`

## Struktur

```
app/Http/Controllers/Admin/   # Controller per modul
app/Http/Middleware/            # EnsureUserIsAdmin
app/Models/                     # User, EventCategory, Venue, Event, TicketType
database/migrations/            # Schema + foreign keys
resources/views/admin/          # Blade per modul
routes/web.php                  # Route terhubung middleware auth + admin
```
