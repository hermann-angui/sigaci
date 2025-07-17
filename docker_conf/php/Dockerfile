# docker/php/Dockerfile
# Use a lightweight PHP 8.3-FPM image
FROM php:8.3-fpm

# Install PHP extensions and dependencies
# Using apt-get for Debian-based images
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev \
    libxml2-dev \
    cron \
    supervisor \
    locales \
    && rm -rf /var/lib/apt/lists/* \

# Set working directory inside the container
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip intl opcache bcmath exif pcntl sockets

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