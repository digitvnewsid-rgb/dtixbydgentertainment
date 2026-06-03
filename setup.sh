#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"

command -v php >/dev/null || { echo "Install PHP 8.3+"; exit 1; }
command -v composer >/dev/null || { echo "Install Composer"; exit 1; }

composer install --no-interaction
[ -f .env ] || cp .env.example .env
grep -q '^APP_KEY=base64:' .env || php artisan key:generate --force

if grep -q '^DB_CONNECTION=sqlite' .env 2>/dev/null; then
  touch database/database.sqlite
fi

php artisan migrate --seed --force
php artisan config:clear

echo ""
echo "Setup selesai. Jalankan: php artisan serve"
echo "Login admin: admin@etms.test / password"
