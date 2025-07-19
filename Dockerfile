# استخدام PHP 8.1 مع Apache
FROM php:8.1-apache

# تثبيت التبعيات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# تثبيت PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت تبعيات PHP
RUN composer install --no-dev --optimize-autoloader

# إنشاء مجلدات مطلوبة
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views
RUN mkdir -p bootstrap/cache

# تعيين الصلاحيات
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# إنشاء قاعدة بيانات SQLite
RUN touch /var/www/html/database/database.sqlite \
    && chmod 664 /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite

# تكوين Apache
RUN a2enmod rewrite
COPY <<EOF /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# إنشاء script للتشغيل
COPY <<EOF /var/www/html/start.sh
#!/bin/bash
# إنشاء APP_KEY إذا لم يكن موجود
if [ -z "\$APP_KEY" ]; then
    export APP_KEY=\$(php artisan key:generate --show --no-ansi)
fi

# تشغيل أوامر Laravel
php artisan config:cache
php artisan route:cache  
php artisan view:cache
php artisan migrate --force

# بدء Apache
apache2-foreground
EOF

RUN chmod +x /var/www/html/start.sh

# فتح المنفذ
EXPOSE 80

CMD ["/var/www/html/start.sh"]