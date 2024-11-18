FROM php:8.3-fpm-alpine

ARG PROJECT_FOLDER=nux

RUN apk add --no-cache \
    libxml2-dev \
    curl-dev \
    oniguruma-dev \
    openssl-dev \
    && docker-php-ext-install \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    mbstring \
    pdo

WORKDIR /var/www/$PROJECT_FOLDER

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data \
    /var/www/$PROJECT_FOLDER/storage \
    /var/www/$PROJECT_FOLDER/bootstrap/cache

RUN chmod -R 775 \
    /var/www/$PROJECT_FOLDER/storage \
    /var/www/$PROJECT_FOLDER/bootstrap/cache

#RUN php artisan migrate
#
#RUN chown www-data:www-data /var/www/$PROJECT_FOLDER/database/database.sqlite
#RUN chmod 775 /var/www/$PROJECT_FOLDER/database/database.sqlite

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
