#FROM php:7.4-fpm
#RUN apt-get update -y
#RUN apt-get install g++ gcc libxml2 libxslt-dev -y
#RUN docker-php-ext-install pdo pdo_mysql soap
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug
#RUN mkdir -p /run/nginx
##COPY docker/nginx.conf /etc/nginx/nginx.conf
#
#RUN mkdir -p /app
#COPY . /app
#
#RUN chown -R www-data: /app

#FROM nginx
#RUN apt-get update -y
#RUN apt-get install g++ gcc libxml2 libxslt-dev php-fpm -y
#RUN mkdir -p /app
#
#COPY cloud-run /app
#COPY cloud-run/default.conf /etc/nginx/conf.d/default.conf
#
#RUN chown -R www-data: /app
#RUN sed -i "s,LISTEN_PORT,80,g" /etc/nginx/conf.d/default.conf

#FROM php:7.4-fpm
#RUN apt update
#RUN apt install g++ gcc libxml2 libxslt-dev nginx -y
#RUN mkdir -p /app
#
#COPY cloud-run /app
#COPY cloud-run/default.conf /etc/nginx/conf.d/default.conf
#
#RUN chown -R www-data: /app
#RUN sed -i "s,LISTEN_PORT,80,g" /etc/nginx/conf.d/default.conf
#
#WORKDIR /app
#
#CMD ["nginx", "-g", "daemon off;"]

#FROM php:7.4-fpm
#
#ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"
#
#RUN apt update
#RUN apt install g++ gcc libxml2 libxslt-dev nginx -y
#RUN mkdir -p /app
#
#COPY cloud-run /app
#COPY cloud-run/default.conf /etc/nginx/conf.d/default.conf
#COPY cloud-run/entrypoint.sh /etc/entrypoint.sh
#
#RUN chown -R www-data: /app
#RUN chmod +x /etc/entrypoint.sh
#RUN sed -i "s,LISTEN_PORT,80,g" /etc/nginx/conf.d/default.conf
#
#WORKDIR /app
#
#EXPOSE 80 443
#
#ENTRYPOINT ["/etc/entrypoint.sh"]

#FROM wyveo/nginx-php-fpm
#
##RUN mkdir -p /app
#
#COPY cloud-run/public /usr/share/nginx/html
#COPY cloud-run/default.conf /etc/nginx/conf.d/default.conf
#
##RUN chown -R www-data: /app
##RUN sed -i "s,LISTEN_PORT,80,g" /etc/nginx/conf.d/default.conf









#FROM php:7.4-fpm
#
#USER root
#
#WORKDIR /var/www
#
## Install dependencies
#RUN apt-get update \
#    # gd
#    && apt-get install -y --no-install-recommends build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev nodejs npm  \
#    && docker-php-ext-configure gd  \
#    && docker-php-ext-install gd \
#    # gmp
#    && apt-get install -y --no-install-recommends libgmp-dev \
#    && docker-php-ext-install gmp \
#    # pdo_mysql
#    && docker-php-ext-install pdo_mysql mbstring \
#    # pdo
#    && docker-php-ext-install pdo \
#    # opcache
#    && docker-php-ext-enable opcache \
#    # zip
#    && docker-php-ext-install zip \
#    && apt-get autoclean -y \
#    && rm -rf /var/lib/apt/lists/* \
#    && rm -rf /tmp/pear/
#
## Copy files
#COPY cloud-run /var/www
#
#COPY post_deploy.sh /etc/post_deploy.sh
#
#COPY cloud-run/deploy/local.ini /usr/local/etc/php/local.ini
#
#COPY cloud-run/deploy/conf.d/nginx.conf /etc/nginx/nginx.conf
#
#RUN chmod +rwx /var/www
#
#RUN chmod -R 777 /var/www
#
## setup npm
##RUN npm install -g npm@latest
##
##RUN npm install
##
##RUN npm rebuild node-sass
##
##RUN npm run prod
#
## setup composer and laravel
##RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
##
##RUN composer install --working-dir="/var/www"
##
##RUN composer dump-autoload --working-dir="/var/www"
##
##RUN php artisan config:clear
##
##RUN php artisan config:cache
#
#EXPOSE 80
#
##RUN ["chmod", "+x", "post_deploy.sh"]
#RUN chmod +x /etc/post_deploy.sh
#
##CMD [ "sh", "./post_deploy.sh" ]
#ENTRYPOINT ["/etc/post_deploy.sh"]
#
## CMD php artisan serve --host=127.0.0.1 --port=9000















FROM php:7.4-fpm

#USER root

#WORKDIR /app

# Install dependencies
#RUN apt-get update \
#    # gd
#    && apt-get install -y --no-install-recommends build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev nodejs npm  \
#    && docker-php-ext-configure gd  \
#    && docker-php-ext-install gd \
#    # gmp
#    && apt-get install -y --no-install-recommends libgmp-dev \
#    && docker-php-ext-install gmp \
#    # pdo_mysql
#    && docker-php-ext-install pdo_mysql mbstring \
#    # pdo
#    && docker-php-ext-install pdo \
#    # soap
#    && docker-php-ext-install soap \
#    # opcache
#    && docker-php-ext-enable opcache \
#    # zip
#    && docker-php-ext-install zip \
#    && apt-get autoclean -y \
#    && rm -rf /var/lib/apt/lists/* \
#    && rm -rf /tmp/pear/

RUN apt update -y
RUN apt install g++ gcc libxml2 libxslt-dev git npm zip unzip nginx -y
RUN docker-php-ext-install pdo pdo_mysql soap

COPY . /app

COPY cloud-run/deploy/post_deploy.sh /etc/post_deploy.sh

COPY cloud-run/deploy/local.ini /usr/local/etc/php/local.ini

COPY cloud-run/deploy/conf.d/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data: /app

#RUN chmod +rwx /app
#
#RUN chmod -R 777 /app

# setup npm
#RUN npm install -g npm@latest
#

# setup composer and laravel
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
#RUN composer install --working-dir="/app"
#
#RUN composer dump-autoload --working-dir="/app"

RUN cd /app && /usr/local/bin/composer install --no-dev

RUN CD /app && npm install
#
#RUN cd /app && npm run prod
#CMD ["npm", "run prod"]

#RUN php artisan config:clear
#
#RUN php artisan config:cache

#EXPOSE 80

RUN chmod +x /etc/post_deploy.sh

ENTRYPOINT ["/etc/post_deploy.sh"]
