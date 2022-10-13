FROM php:8.1-fpm

RUN apt update && apt install -y \
        zip \
        bash \
        libpq-dev \
        libzip-dev \
        libpng-dev \
    && docker-php-ext-install \
        zip \
        pdo \
        gd \
        calendar \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:1.10.25 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/vhosts/g-framework

COPY config/php.ini /usr/local/etc/php/php.ini

