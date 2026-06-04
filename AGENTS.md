# AGENTS.md

Guidance for AI agents working in this repository.

## Stack

Laravel 13 (PHP 8.3+), SQLite default, Blade admin panel — DTIX BYDG Entertainment ticketing admin.

## Cursor Cloud specific instructions

Single Laravel app (ETMS). See [README.md](README.md) for full setup; this section covers non-obvious cloud VM behavior.

### First-time VM (if PHP/Composer missing)

PHP 8.3+ with extensions: `mbstring`, `xml`, `curl`, `zip`, `sqlite3`, `mysql`, `bcmath`, `intl`, `gd`. Composer is often installed at `~/.local/bin/composer` — add `export PATH="$HOME/.local/bin:$PATH"` in your shell before `composer` commands.

One-shot app setup: `./setup.sh` (uses `.env`; ensure `DB_CONNECTION=sqlite` and `touch database/database.sqlite` if MySQL is unavailable).

### Commands (after deps exist)

| Task | Command |
|------|---------|
| Install PHP deps | `composer install` |
| Install JS deps | `npm install --ignore-scripts` |
| Env + key | `cp .env.example .env && php artisan key:generate` |
| DB (SQLite) | `touch database/database.sqlite && php artisan migrate --seed` |
| Build assets | `npm run build` (optional; Blade falls back to CDN if no build) |
| Dev server | `php artisan serve --host=0.0.0.0 --port=8000` |
| All-in-one dev | `composer dev` (serve + queue + pail + Vite) |
| Tests | `php artisan test` or `composer test` |
| PHP format check | `./vendor/bin/pint --test` |

Run long-lived `php artisan serve` in **tmux** (e.g. session `laravel-serve`), not as a one-shot background job.

### Admin login (seed)

- Email: `admin@etms.test`
- Password: `password`
- URL: `/login` (redirects to role dashboard, e.g. `/admin/dashboard`)

Other demo accounts: `creator@etms.test`, `customer@etms.test`, `ticketing@etms.test` (same password).

### Module map

| Modul | Routes | Middleware |
|-------|--------|------------|
| Auth | `/login`, `/register`, logout | `guest` / `auth` |
| Dashboard | `/admin/dashboard` | `auth`, `role:administrator` |
| Kategori | `/admin/categories` | `auth`, `role:administrator` |
| Event | `/admin/events`, `/creator/events` | role-specific |
| User | `/admin/users` | `auth`, `role:administrator` |

Unauthenticated users are redirected to `login` (see `bootstrap/app.php`).

### Next module

**Tipe Tiket** — CRUD `ticket_types` per event (migration & model exist; add controller + views).
