FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip unzip git curl libonig-dev libzip-dev libxml2-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite

RUN a2enmod rewrite

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader && \
    php artisan key:generate && \
    php artisan migrate --force && \
    php artisan storage:link

EXPOSE 80
