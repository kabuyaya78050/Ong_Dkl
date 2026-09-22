FROM php:8.3-fpm

ARG APP_ENV=production
ENV APP_ENV=${APP_ENV} \
    DEBIAN_FRONTEND=noninteractive \
    PORT=10000

WORKDIR /var/www

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    gettext-base \
    git \
    libicu-dev \
    libonig-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    nginx \
    unzip \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        bcmath \
        exif \
        gd \
        mbstring \
        pcntl \
        pdo_pgsql \
        pgsql \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-progress --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN npm install --no-fund --no-audit \
    && npm run build \
    && rm -rf node_modules \
    && chown -R www-data:www-data storage bootstrap/cache public \
    && chmod -R 775 storage bootstrap/cache public \
    && php artisan package:discover --ansi || true

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf.template
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 10000

CMD ["/usr/local/bin/start.sh"]