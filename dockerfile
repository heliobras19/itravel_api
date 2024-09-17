FROM php:8.1-fpm

# Instalar extensões PHP
RUN apt-get update && apt-get install -y \
    libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache

RUN chown -R application:application .

# Expor porta
EXPOSE 8000

# Comando para iniciar o servidor
CMD ["php-fpm"]