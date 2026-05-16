# syntax=docker/dockerfile:1

FROM composer:2 AS vendor

WORKDIR /app

COPY laravel/composer.json laravel/composer.lock ./
RUN composer install \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-scripts

COPY laravel ./
RUN composer dump-autoload --optimize


FROM node:22-bookworm-slim AS assets

WORKDIR /app

COPY laravel/package.json laravel/package-lock.json laravel/vite.config.js laravel/postcss.config.js laravel/tailwind.config.js ./
RUN npm ci

COPY laravel/resources ./resources
COPY laravel/public ./public
RUN npm run build


FROM php:8.3-fpm-bookworm AS app

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends libzip-dev supervisor unzip \
    && docker-php-ext-install pdo_mysql zip opcache \
    && rm -rf /var/lib/apt/lists/*

COPY docker/app/entrypoint.sh /usr/local/bin/erp-entrypoint
COPY docker/app/supervisord.conf /etc/supervisor/conf.d/erp.conf

COPY --chown=www-data:www-data laravel ./
COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor
COPY --from=assets --chown=www-data:www-data /app/public/build ./public/build

RUN chmod +x /usr/local/bin/erp-entrypoint \
    && php artisan package:discover --ansi \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["erp-entrypoint"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/erp.conf"]


FROM nginx:1.27-alpine AS nginx

WORKDIR /var/www/html

RUN apk add --no-cache netcat-openbsd

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY docker/nginx/wait-for-php-fpm.sh /docker-entrypoint.d/40-wait-for-php-fpm.sh
COPY laravel/public ./public
COPY --from=assets /app/public/build ./public/build
RUN chmod +x /docker-entrypoint.d/40-wait-for-php-fpm.sh \
    && ln -s /var/www/html/storage/app/public /var/www/html/public/storage

EXPOSE 80
