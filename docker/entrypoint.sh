#!/bin/sh
set -e

echo "[entrypoint] Initialisation Laravel..."

cd /var/www/html

composer install
npm install
php artisan key:generate || true
php artisan migrate --force || true
npm run build || true

echo "[entrypoint] Laravel prêt."

exec apache2-foreground
