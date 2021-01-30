FROM php:8-fpm

RUN apt update -y
RUN apt install g++ gcc libxml2 libxslt-dev npm zip unzip nginx -y
RUN docker-php-ext-install pdo pdo_mysql soap

#install and enable xdebug
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug

#install latest node version
RUN npm cache clean -f
RUN npm install -g n
RUN n stable

COPY . /app

COPY cloud-run/deploy/post_deploy.sh /etc/post_deploy.sh

COPY cloud-run/deploy/local.ini /usr/local/etc/php/local.ini

COPY cloud-run/deploy/conf.d/nginx.conf /etc/nginx/nginx.conf

COPY cloud-run/deploy/conf.d/mime.types /etc/nginx/mime.types

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data: /app

WORKDIR /app

RUN composer install --no-dev --ignore-platform-reqs

RUN npm install --production

RUN chmod +x /etc/post_deploy.sh

RUN chmod -R 0777 storage/logs

ENTRYPOINT ["/etc/post_deploy.sh"]
