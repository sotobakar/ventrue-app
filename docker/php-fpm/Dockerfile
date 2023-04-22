FROM php:8.1-fpm-alpine

# Install necessary packages
RUN apk add --no-cache \
    nodejs npm \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    openssl-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    gd \
    zip \
    intl \
    mbstring \
    bcmath \
    opcache \
    exif \
    pcntl \
    soap \
    sockets

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy necessary files
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# Install Node.js dependencies
RUN npm install

# Install PHP dependencies
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts --no-autoloader \
    && composer clear-cache \
    && rm -rf /tmp/*

COPY . .

# Generate autoload files
RUN composer dump-autoload --no-dev --classmap-authoritative

# Build production assets
RUN npm run build

# Set the appropriate file permissions
RUN chown -R www-data:www-data /var/www/storage && \
    chown -R www-data:www-data /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage && \
    chmod -R 775 /var/www/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]