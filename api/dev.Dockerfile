FROM php:8.3-fpm-alpine3.20

# Install nginx
RUN apk update && apk add nginx

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Install composer
COPY --from=composer:2.8.4 /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY ./composer.json ./composer.lock ./

# Install dependencies
RUN composer install --no-scripts

# Copy source code
COPY . .

# Run cache clear, install static assets and remove composer
RUN php bin/console cache:clear && \
    php bin/console assets:install public/ && \
    rm -rf /usr/bin/composer

# Set permissions for symfony cache and logs folder
RUN chown -R www-data:www-data /var/www/html/var

# Move nginx config to the correct folder
RUN mv /var/www/html/docker/nginx.conf /etc/nginx/nginx.conf

# Using personnalised entrypoint
ENTRYPOINT ["/bin/sh", "/var/www/html/docker/entrypoint.sh"]
