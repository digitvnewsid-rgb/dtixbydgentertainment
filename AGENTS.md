# AGENTS.md

Guidance for AI agents working in this repository.

## Stack

Laravel 13 (PHP 8.3+), SQLite default, Blade admin panel — DTIX BYDG Entertainment ticketing admin.

## Cursor Cloud specific instructions

### One-time VM setup (PHP not preinstalled)

```bash
sudo apt-get update && sudo apt-get install -y php8.3-cli php8.3-sqlite3 php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-bcmath php8.3-intl unzip
curl -sS https://getcomposer.org/installer | php -- --install-dir=$HOME/.local/bin --filename=composer
export PATH="$HOME/.local/bin:$PATH"
```

Or run `./setup.sh` after Composer is on `PATH` and `.env` uses `DB_CONNECTION=sqlite` (uncomment in `.env.example` before copying, or edit `.env` after `cp`).

### Commands

- Install: `composer install`
- Env: `cp .env.example .env && php artisan key:generate` (prefer SQLite for Cloud VM — see `.env.example` comment)
- DB: `touch database/database.sqlite && php artisan migrate --seed`
- Dev server: `php artisan serve` (bind `0.0.0.0` if testing from a remote browser)
- Tests: `php artisan test`
- Lint: `./vendor/bin/pint --test`

### Demo login (seed, password `password`)

| Role | Email |
|------|--------|
| Administrator | `admin@etms.test` |
| Creator | `creator@etms.test` |
| Customer | `customer@etms.test` |
| Ticketing | `ticketing@etms.test` |

Auth URLs: `/login`, `/register`, `POST /logout`. After login, admins land on `/admin/dashboard`.

### Module map (administrator)

| Modul | Routes | Middleware |
|-------|--------|------------|
| Auth | `/login`, `/register`, `/logout` | `guest` / `auth` |
| Dashboard | `/admin/dashboard` | `auth`, `role:administrator` |
| Users | `/admin/users` | `auth`, `role:administrator` |
| Kategori | `/admin/categories` | `auth`, `role:administrator` |
| Acara | `/admin/events` (+ publish/close/cancel) | `auth`, `role:administrator` |
| Jenis tiket | `/admin/events/{event}/ticket-types` | `auth`, `role:administrator` |

Creator prefix: `/creator/*` with `role:creator`. Health: `GET /up`.

### Gotchas

- **Node/Vite optional** — views fall back to Tailwind CDN if `npm run build` was not run.
- **Tests** — as of setup verification, `php artisan test` reports 12/13 passing; `PhaseTwoEventManagementTest::test_public_home_only_shows_published_events` fails because `public/home.blade.php` calls `hasPages()` on a non-paginated collection (500 on `/`).
- **Pint** — `./vendor/bin/pint --test` may report style drift on a clean checkout; run `./vendor/bin/pint` only when intentionally formatting.
