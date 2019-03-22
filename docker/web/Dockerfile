FROM php:7.3.3-apache
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN chmod -R 777 /var/www/html
CMD ["apache2-foreground"]
