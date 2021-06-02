#!/bin/sh

cd /app || exit

sed -i "s,SABLE_PORT,${PORT},g" /etc/nginx/sites-available/default
sed -i "s,SABLE_SERVER_NAME,${APP_NAME},g" /etc/nginx/sites-available/default
sed -i "s,SABLE_APP_URL,${APP_URL},g" /etc/nginx/sites-available/default

# start the application
php-fpm -D && nginx -g "daemon off;"

php artisan migrate --force

exec "$@"
