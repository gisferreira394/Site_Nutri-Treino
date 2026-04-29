FROM php:8.2-apache

# Instala extensões MySQL necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia os arquivos do projeto
COPY . /var/www/html/

# Permissões corretas
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80