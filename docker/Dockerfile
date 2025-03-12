FROM php:8.3-fpm-alpine AS staging

WORKDIR /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN apk add --no-cache \
    autoconf \
    bash \
    curl \
    g++ \
    git \
    libpq \
    libzip-dev \
    linux-headers \
    make \
    netcat-openbsd \
    oniguruma-dev \
    openssl \
    postgresql-client \
    postgresql-dev \
    redis \
    supervisor \
    unzip \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install -j$(nproc) \
    pcntl \
    pdo \
    pdo_pgsql \
    pgsql \
    sockets \
    zip \
    mbstring \
    gd \
    intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-source delete \
    && mkdir -p \
    bootstrap/cache \
    storage/framework/{cache,sessions,testing,views} \
    storage/logs \
    storage/app/public/images \
    && chown -R www-data:www-data \
    bootstrap/cache \
    storage \
    && chmod -R 777 \
    bootstrap/cache \
    storage \
    && echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory-limit.ini

FROM staging AS base
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.* ./


FROM base AS entrypoint-base
COPY docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh


FROM base AS artisan-base
COPY --from=entrypoint-base /usr/local/bin/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY . .
ENTRYPOINT ["entrypoint.sh"]

FROM artisan-base AS development-artisan
ENV APP_ENV=local \
    APP_DEBUG=true
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8000 --verbose 2>&1"]

FROM base AS development
ENV APP_ENV=local \
    APP_DEBUG=true
RUN composer install --no-scripts --no-interaction --optimize-autoloader
COPY . .

FROM development AS development-queue
CMD ["sh", "-c", "php artisan queue:listen --verbose 2>&1"]

FROM development AS development-reverb
CMD ["sh", "-c", "php artisan reverb:start --debug 2>&1"]
