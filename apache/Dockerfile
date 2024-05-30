FROM php:8.3-apache

ARG APCU_VERSION=5.1.22

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zip \
        imagemagick \
        ffmpeg \
        xpdf \
        exiftool \
        antiword \
        libzip-dev \
        libicu-dev \
        vim

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install pdo pdo_mysql mysqli exif zip

RUN docker-php-ext-configure intl && docker-php-ext-install intl

RUN pecl install apcu-${APCU_VERSION} && docker-php-ext-enable apcu
RUN echo "extension=apcu.so" >> /usr/local/etc/php/php.ini
RUN echo "apc.enable_cli=1" >> /usr/local/etc/php/php.ini
RUN echo "apc.enable=1" >> /usr/local/etc/php/php.ini

RUN a2enmod rewrite && a2enmod ssl && a2enmod socache_shmcb
RUN a2ensite default-ssl