# Use the official PHP image as the base image
FROM php:7.4-fpm

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    ...

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files
COPY . .

# Install Laravel dependencies
RUN composer install

# Copy the .env file (customize this according to your needs)
COPY .env.example .env

# Generate the application key
RUN php artisan key:generate

# Run migrations and seed the database (if needed)
RUN php artisan migrate --seed

# Expose the port the application runs on
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
