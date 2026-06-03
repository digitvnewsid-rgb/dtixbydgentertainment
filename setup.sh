#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

if ! command -v php >/dev/null 2>&1; then
  echo "ERROR: PHP tidak ditemukan. Install PHP 8.3+ terlebih dahulu."
  exit 1
fi

if ! command -v composer >/dev/null 2>&1; then
  echo "ERROR: Composer tidak ditemukan. Install dari https://getcomposer.org"
  exit 1
fi

echo "==> composer install"
composer install --no-interaction --prefer-dist

if [ ! -f .env ]; then
  echo "==> membuat .env"
  cp .env.example .env
fi

# Pakai session/cache file agar tidak error 500 sebelum migrate
if grep -q '^SESSION_DRIVER=database' .env 2>/dev/null; then
  sed -i 's/^SESSION_DRIVER=database/SESSION_DRIVER=file/' .env
fi
if grep -q '^CACHE_STORE=database' .env 2>/dev/null; then
  sed -i 's/^CACHE_STORE=database/CACHE_STORE=file/' .env
fi
if grep -q '^QUEUE_CONNECTION=database' .env 2>/dev/null; then
  sed -i 's/^QUEUE_CONNECTION=database/QUEUE_CONNECTION=sync/' .env
fi

chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "==> php artisan dtix:setup"
php artisan dtix:setup

echo ""
echo "Selesai. Jalankan: php artisan serve"
echo "Cek diagnosa: http://127.0.0.1:8000/cek-setup.php"
echo "Login admin: http://127.0.0.1:8000/admin/login"
echo "Email: admin@dtix.test  Password: password"
