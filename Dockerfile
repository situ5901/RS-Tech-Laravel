# Use the official PHP image as the base image
FROM php:8

# Set the working directory inside the container
WORKDIR /app

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the Laravel project files into the container
COPY . /app

# Install Laravel dependencies
RUN composer install

# Generate Laravel application key
RUN php artisan key:generate



# Expose ports for Laravel and phpMyAdmin
EXPOSE 8000 8080

# Wait for MySQL service to be ready
CMD /bin/bash -c "while ! nc -z db 3307; do sleep 3; done && service apache2 start && php artisan serve --host=0.0.0.0 --port=8000"
