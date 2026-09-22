FROM php:8.3-fpm-bookworm

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
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    libzip-dev \
    nginx \
    unzip \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql pgsql mbstring bcmath exif pcntl gd zip \
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