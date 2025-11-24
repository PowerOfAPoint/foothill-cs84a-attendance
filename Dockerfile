FROM php:8.2.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /var/www/html
USER www-data
