FROM php:8-fpm

RUN apt-get update && apt-get install -y \
    zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
