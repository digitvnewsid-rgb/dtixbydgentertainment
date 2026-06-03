# AGENTS.md

## Cursor Cloud specific instructions

### Stack

Laravel 13 (PHP 8.3), SQLite default, Blade admin panel.

### Commands

- Install: `composer install`
- DB: `php artisan migrate --seed`
- Dev server: `php artisan serve`
- Tests: `php artisan test`

### Admin login (seed)

- Email: `admin@dtix.test`
- Password: `password`

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

**Tipe Tiket** — CRUD `ticket_types` per event (migration & model already exist; add controller + views).
