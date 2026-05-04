FROM php:8.2-apache
RUN a2dismod mpm_event && a2enmod mpm_prefork
RUN apt-get update && apt-get install -y libcurl4-openssl-dev && docker-php-ext-install mysqli curl
COPY . /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]
