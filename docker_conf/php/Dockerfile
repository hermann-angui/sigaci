# docker/php/Dockerfile
# Use a lightweight PHP 8.3-FPM image
FROM php:8.3-fpm

# Install PHP extensions and dependencies
# Using apt-get for Debian-based images
RUN apt-get update --fix-missing && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    zip \
    rsync \
    gzip \
    nano \
    sudo \
    cron \
    supervisor \
    git \
    zip \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev \
    libpq-dev \
    libxpm-dev \
    libvpx-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    libxrender1 \
    libfontconfig1 \
    fontconfig

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev curl git unzip libxml2-dev libpq-dev && \
    pecl install apcu && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql pdo_mysql bcmath exif gd gettext && \
    docker-php-ext-enable apcu pdo_pgsql pdo_mysql sodium && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- \
   --install-dir=/usr/bin --filename=composer --version=2.8.9

WORKDIR /var/www/html

# Install system dependencies and PHP extensions
# gd: For image manipulation
# pdo_mysql: For MySQL database connection
# intl: For internationalization
# zip: For handling zip archives
# opcache: PHP opcode cache for performance
# xdebug: PHP debugger (for development)
# cron: For running scheduled tasks
# supervisor: A process control system (optional, but good for managing cron and php-fpm)

# Copy custom php.ini configuration
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Copy cron job configuration
# This copies a file named 'cronjob' into the container's crontabs directory for the root user.
# The cronjob file should contain your cron schedule and command.
COPY cronjob /etc/crontabs/root
# Give execute permissions to the cronjob file (if it's a script)
RUN chmod 0644 /etc/crontabs/root

# Set up cron to run in the background
RUN crontab /etc/crontabs/root
RUN touch /var/log/cron.log

# Configure Supervisor to manage php-fpm and cron
COPY supervisord.conf /etc/supervisord.conf
# This ensures that both php-fpm and cron are running.
# If you don't use supervisor, you'd need to run both commands in your CMD.
# For example: CMD sh -c "crond -f & php-fpm"

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start Supervisor which will manage php-fpm and cron
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]