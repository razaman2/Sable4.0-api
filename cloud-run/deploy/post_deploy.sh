#!/bin/sh

cd /app || exit
php artisan env

npm run prod

php artisan telescope:install
php artisan migrate

sed -i "s,PORT,${PORT},g" /etc/nginx/conf.d/default.conf
sed -i "s,APP_URL,${APP_URL},g" /etc/nginx/conf.d/default.conf

# start the application
php-fpm -D && nginx -g "daemon off;"
