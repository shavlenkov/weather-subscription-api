FROM php:8.3-fpm

RUN apt-get update && \
    apt-get install -y \
    git \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY ./_docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www

COPY . .

RUN chmod -R 775 .

EXPOSE 9000

CMD ["php-fpm"]
