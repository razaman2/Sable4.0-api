#!/bin/bash
echo "ainsley's server port is: $PORT"
echo "my newest build!"
sed -i "s,LISTEN_PORT,8000,g" /etc/nginx/nginx.conf

exec "$@"
