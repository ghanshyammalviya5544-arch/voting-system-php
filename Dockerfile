FROM php:8.2-apache
RUN apt-get update && apt-get install -y libcurl4-openssl-dev \
    && docker-php-ext-install mysqli curl \
    && a2dismod mpm_event mpm_worker mpm_prefork \
    && a2enmod mpm_prefork rewrite
COPY . /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]
