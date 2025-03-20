FROM php:8.2-apache

# Устанавливаем расширения для работы с MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Включаем модуль Apache для работы с .htaccess (если нужен)
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


WORKDIR /var/www/html

EXPOSE 80   