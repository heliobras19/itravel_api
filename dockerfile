# Use uma imagem base oficial do PHP
FROM php:8.1-fpm

RUN apk add oniguruma-dev postgresql-dev libxml2-dev
# Instalar extensões necessárias
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        json \
        mbstring \
        pdo_mysql \
        pdo_pgsql \
        tokenizer \
        xml

# Definir o diretório de trabalho
#WORKDIR /var/www/html

# Copiar arquivos da aplicação para o container
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