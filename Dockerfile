FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    libpq-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel config
RUN php artisan config:cache

# Expose port and run Laravel
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
