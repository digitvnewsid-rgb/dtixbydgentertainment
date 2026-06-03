# AGENTS.md

Guidance for AI agents working in this repository.

## Stack

Laravel 13 (PHP 8.3+), SQLite default, Blade admin panel — DTIX BYDG Entertainment ticketing admin.

## Cursor Cloud specific instructions

### Commands

- Install: `composer install`
- Env: `cp .env.example .env && php artisan key:generate`
- DB: `touch database/database.sqlite && php artisan migrate --seed`
- Dev server: `php artisan serve`
- Tests: `php artisan test`

### Admin login (seed)

- Email: `admin@dtix.test`
- Password: `password`
- URL: `/admin/login`

### Module map

| Modul | Routes | Middleware |
|-------|--------|------------|
| Auth | `admin/login`, `admin/logout` | `guest` / `auth` + `admin` |
| Dashboard | `admin/dashboard` | `auth`, `admin` |
| Kategori | `admin/categories` | `auth`, `admin` |
| Venue | `admin/venues` | `auth`, `admin` |
| Acara | `admin/events` | `auth`, `admin` |

Guests redirect to `admin.login` (see `bootstrap/app.php`).

### Next module

**Tipe Tiket** — CRUD `ticket_types` per event (migration & model exist; add controller + views).
