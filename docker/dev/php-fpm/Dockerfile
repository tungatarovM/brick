FROM php:7.4-fpm

RUN apt-get update && apt-get install -y iputils-ping autoconf g++ make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y libmcrypt-dev libpq-dev \
    && pecl install mcrypt-1.0.3 \
#    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo pdo_pgsql

COPY ./docker/dev/php/local /usr/local/etc/php/conf.d
COPY ./docker/dev/php/conf.d /usr/local/etc/php/conf.d

USER 1000

WORKDIR /var/www
