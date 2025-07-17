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
    # System dependencies required at runtime
    nginx \
    git \
    unzip \
    libzip \
    libpng \
    libjpeg-turbo \
    libwebp \
    icu-libs \
    libsodium \
    imagemagick \
    # For connecting to PostgreSQL/MySQL from the shell (optional)
    postgresql-client \
    mysql-client \
    && apk add --no-cache --virtual .build-deps \
    # Build-time dependencies for compiling PHP extensions
    $PHPIZE_DEPS \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    postgresql-dev \
    libsodium-dev \
    icu-dev \
    imagemagick-dev \
    # Install core PHP extensions
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
    gd \
    zip \
    intl \
    sodium \
    pdo_mysql \
    pdo_pgsql \
    # Install PECL extensions
    && pecl install apcu imagick xdebug \
    # Enable all installed extensions
    && docker-php-ext-enable \
    opcache \
    apcu \
    imagick \
    xdebug \
    # Clean up build dependencies and apk cache
    && apk del .build-deps \
    && rm -rf /tmp/pear ~/.pearrc /var/cache/apk/*

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