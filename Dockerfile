FROM php:8.2-apache

RUN apt-get update && apt-get install -y libcurl4-openssl-dev && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mysqli curl

RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf && \
    sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

EXPOSE ${PORT}
CMD ["apache2-foreground"]
