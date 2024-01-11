FROM php:7.4-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

WORKDIR /var/www/html

COPY . .

CMD ["apache2-foreground"]