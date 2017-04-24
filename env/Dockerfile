FROM php:7.0-apache
MAINTAINER Richard Olsson <r@richardolsson.se>

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && apt-get install -y libpng12-dev libjpeg-dev && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install gd mysqli

# Install Wordpress
RUN curl -q -SL https://wordpress.org/latest.tar.gz |tar xz -C /var/www
RUN mv /var/www/wordpress/* /var/www/html/

# Enable mod_rewrite
RUN a2enmod rewrite

# Add Wordpress configuration
ADD wp-config.php /var/www/html/wp/wp-config.php
ADD php.ini /usr/local/etc/php/conf.d/wordpress.ini
RUN chown -R www-data:www-data /var/www/html
