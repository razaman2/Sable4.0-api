#!/bin/sh

echo "current working directory is currently."
pwd
cd /app || exit
pwd
php artisan env
npm -v
node -v
env


# start the application
php-fpm -D && nginx -g "daemon off;"
