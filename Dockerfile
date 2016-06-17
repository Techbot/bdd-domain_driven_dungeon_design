FROM php:7.0.7-apache
COPY html   /var/www/html
COPY src    /var/www/src
COPY app    /var/www/app
COPY bin    /var/www/bin
COPY var    /var/www/var
COPY vendor /var/www/vendor

EXPOSE 80

RUN docker-php-ext-install pdo pdo_mysql

CMD ["apache2-foreground"]

