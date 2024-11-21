FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
		nano \
		libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        gnupg \
        libicu-dev \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql sockets \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN pecl install xdebug \ && docker-php-ext-enable xdebug
RUN pecl install -o -f redis \ &&  rm -rf /tmp/pear \ &&  docker-php-ext-enable redis
RUN pecl install zip \ && docker-php-ext-enable zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR "/application"
