FROM php:8.1-apache

# Metadata
LABEL maintainer="kontakt@malarz.trzebnica.pl"
LABEL description="Malarz Trzebnica - Docker Image"

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./dist /var/www/html

# Install PHP dependencies
RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader; fi

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure PHP
COPY docker/php/php.ini /usr/local/etc/php/

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
