# Dockerfile.php
# Use the official PHP 8.3 FPM image
FROM php:8.3-fpm-alpine

# Install common PHP extensions and dependencies for Symfony
# gd: for image manipulation
# pdo_pgsql: for PostgreSQL database connection (uncomment if needed)
# zip: for composer to extract archives
# unzip: for composer to extract archives
# git: for composer to fetch packages
# pdo_mysql: for MySQL database connection
# sodium: for Symfony's security component
RUN apk add --no-cache \
nginx \
git \
unzip \
libzip-dev \
libpng-dev \
libjpeg-turbo-dev \
libwebp-dev \
postgresql-dev \
mysql-client \
mysql-dev \
# For Symfony's security component
libsodium-dev \
# For opcache and apcu
php83-opcache \
php83-apcu \
# For intl extension
icu-dev \
# For imagick (uncomment if needed)
# imagemagick-dev \
# For xdebug (uncomment if needed for debugging)
# php83-xdebug \
&& docker-php-ext-configure gd --with-jpeg --with-webp \
&& docker-php-ext-install -j$(nproc) gd pdo_pgsql zip intl sodium pdo_mysql \
# && docker-php-ext-install imagick # Uncomment if you need imagick
# && docker-php-ext-enable xdebug # Uncomment if you need xdebug

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Symfony application (optional, if you want to build the image with code)
# COPY . /var/www/html

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]