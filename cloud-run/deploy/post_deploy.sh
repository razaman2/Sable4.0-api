#!/bin/sh

cd /app || exit
php artisan env

npm run prod

php artisan telescope:install
php artisan migrate

sed -i "s,PORT,${PORT},g" /etc/nginx/nginx.conf
sed -i "s,SERVER_NAME,${APP_NAME},g" /etc/nginx/nginx.conf

# start the application
php-fpm -D && nginx -g "daemon off;"
