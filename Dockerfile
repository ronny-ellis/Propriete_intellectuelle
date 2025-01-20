FROM php:8.2-cli

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app/.

# Ensure necessary directories exist
RUN mkdir -p /var/log/nginx && mkdir -p /var/cache/nginx

# Install dependencies
RUN composer install --ignore-platform-reqs
