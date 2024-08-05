FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo_mysql iconv simplexml \
    && CFLAGS="-I/usr/src/php" docker-php-ext-install xmlreader \
    && apt-get purge -y --auto-remove libxml2-dev \
    && rm -r /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache

COPY ./php.ini /usr/local/etc/php/php.ini

EXPOSE 9000

CMD ["php-fpm"]
