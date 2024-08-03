FROM php:8.3-fpm

WORKDIR /var/www

COPY composer.lock composer.json /var/www/

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libxml2-dev \
    libgd-dev \
    zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip xml gd dom simplexml xmlreader zlib

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql mbstring zip exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www
COPY --chown=www:www . /var/www

USER www

EXPOSE 9000
CMD ["php-fpm"]
