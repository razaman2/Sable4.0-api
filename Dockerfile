FROM php:8-fpm

RUN apt update -y
RUN apt install g++ gcc libxml2 libxslt-dev git npm zip unzip nginx -y
RUN docker-php-ext-install pdo pdo_mysql soap

COPY . /app

COPY cloud-run/deploy/post_deploy.sh /etc/post_deploy.sh

COPY cloud-run/deploy/local.ini /usr/local/etc/php/local.ini

COPY cloud-run/deploy/conf.d/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data: /app

WORKDIR /app

RUN composer install --no-dev --ignore-platform-reqs

RUN npm install

#RUN npm run prod

RUN chmod +x /etc/post_deploy.sh
RUN chmod -R 0777 storage/logs

ENTRYPOINT ["/etc/post_deploy.sh"]

RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan config:clear
RUN php artisan view:clear
#RUN php artisan migrate --force

#RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/localhost.key -out /etc/ssl/certs/localhost.crt -config cloud-run/deploy/localhost.conf
