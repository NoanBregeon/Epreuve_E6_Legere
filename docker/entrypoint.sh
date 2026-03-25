#!/bin/sh
set -e

APP_USER="${APP_USER:-www-data}"
INIT_MARKER="/var/www/html/storage/.docker_init_done"

run_as_app_user() {
    su -s /bin/sh -c "$1" "$APP_USER"
}

if [ ! -f "$INIT_MARKER" ] || [ "${FORCE_INIT:-false}" = "true" ]; then
    echo "[entrypoint] Initialisation Laravel en cours..."

    run_as_app_user "cd /var/www/html && composer update"
    run_as_app_user "cd /var/www/html && npm install"
    run_as_app_user "cd /var/www/html && php artisan migrate --force"
    run_as_app_user "cd /var/www/html && php artisan migrate:fresh --seed --force"
    run_as_app_user "cd /var/www/html && npm run build"

    touch "$INIT_MARKER"
    chown "$APP_USER":"$APP_USER" "$INIT_MARKER"

    echo "[entrypoint] Initialisation Laravel terminee."
else
    echo "[entrypoint] Initialisation deja effectuee (storage/.docker_init_done)."
fi

exec apache2-foreground
