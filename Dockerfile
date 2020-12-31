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

RUN cd /app && /usr/local/bin/composer install --no-dev

RUN cd /app && npm install --only=production

RUN chmod +x /etc/post_deploy.sh

ENTRYPOINT ["/etc/post_deploy.sh"]
