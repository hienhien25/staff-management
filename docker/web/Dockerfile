FROM php:7.3.3-apache
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN chmod -R 777 /var/www/html
RUN docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
	php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y libzip-dev \
	&& docker-php-ext-install zip
RUN a2enmod rewrite
CMD ["apache2-foreground"]
