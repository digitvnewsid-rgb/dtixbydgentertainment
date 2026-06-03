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
  php artisan key:generate --ansi
fi

if [ ! -f database/database.sqlite ]; then
  echo "==> membuat database SQLite"
  touch database/database.sqlite
fi

echo "==> migrate & seed"
php artisan migrate --seed --force

echo ""
echo "Selesai. Jalankan: php artisan serve"
echo "Login admin: admin@dtix.test / password"
echo "URL: http://127.0.0.1:8000/admin/login"
