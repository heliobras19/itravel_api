# Use uma imagem base oficial do PHP
FROM php:8.1-fpm

# Instalar extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Definir o diretório de trabalho
#WORKDIR /var/www/html

# Copiar arquivos da aplicação para o container
COPY . .

# Instalar as dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Definir as permissões corretas
#RUN chown -R www-data:www-data /var/www/html

# Rodar o comando para gerar cache de configuração do Laravel
RUN php artisan config:cache

# Expor a porta da aplicação
EXPOSE 8000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]
