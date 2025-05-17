FROM php:8.3-fpm

RUN apt-get update && \
    apt-get install -y \
    git \
    libpq-dev \
    unzip \
    cron \
    systemctl \
    nano \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY ./_docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www

COPY . .

EXPOSE 9000

CMD ["php-fpm"]
