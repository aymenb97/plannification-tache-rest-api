FROM php:7.4-apache
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ADD ./000-default.conf /etc/apache2/sites-available
RUN apt-get update && apt-get install -y git
WORKDIR /var/www/html
COPY --chown=www-data:www-data . /var/www/html/
RUN composer config extra.symfony.allow-contrib true
RUN composer install
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql
RUN a2enmod rewrite
