#!/bin/sh

cd /app || exit
php artisan env

npm run prod

php artisan telescope:install
php artisan migrate


# start the application
php-fpm -D && nginx -g "daemon off;"
