FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# نسخ إعدادات Apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# نسخ Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ضبط مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت الحزم
RUN composer install --no-dev --optimize-autoloader

# إعطاء صلاحيات للمجلدات المهمة
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# فتح المنفذ
EXPOSE 80

# بدء Apache بعد تنظيف كاش Laravel
CMD php artisan config:clear && php artisan route:clear && apache2-foreground
