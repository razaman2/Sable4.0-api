#!/bin/sh

echo "current working directory is currently."
echo pwd

# start the application
php-fpm -D && nginx -g "daemon off;"
