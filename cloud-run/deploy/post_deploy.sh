#!/bin/sh

cd /app || exit

sed -i "s,SABLE_PORT,${PORT},g" /etc/nginx/nginx.conf
sed -i "s,SABLE_SERVER_NAME,${APP_NAME},g" /etc/nginx/nginx.conf
sed -i "s,SABLE_APP_URL,${APP_URL},g" /etc/nginx/nginx.conf

# start the application
php-fpm -D && nginx -g "daemon off;"

env

exec "$@"
