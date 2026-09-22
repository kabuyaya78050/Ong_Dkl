#!/bin/sh

set -e

export PORT="${PORT:-10000}"

echo "Démarrage de Laravel sur le port ${PORT}"

if [ -z "${APP_KEY}" ]; then
    php artisan key:generate --force --no-interaction || true
fi

php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

envsubst '${PORT}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

php-fpm -D
nginx -g "daemon off;"