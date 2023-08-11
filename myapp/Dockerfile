FROM php:7.4-fpm
EXPOSE 9000
COPY --chown=www-data:www-data index.php /var/www/html/index.php
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql

