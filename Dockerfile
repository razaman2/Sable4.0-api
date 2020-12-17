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

FROM nginx
RUN mkdir -p /app
COPY nginx /app
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
