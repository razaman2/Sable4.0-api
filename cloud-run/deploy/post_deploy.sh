#!/bin/sh

cd /app || exit

env

npm run prod

#php artisan telescope:install

sed -i "s,PORT,${PORT},g" /etc/nginx/nginx.conf
sed -i "s,SERVER_NAME,${APP_NAME},g" /etc/nginx/nginx.conf

# start the application
php-fpm -D && nginx -g "daemon off;"

#php artisan migrate
