FROM php:8.1-fpm

USER root

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev   # Adicione esta linha para a extensão PDO MySQL

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql   # Adicione esta linha para a extensão PDO MySQL

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define a UID e o nome do usuário
ARG uid=1000
ARG user=myuser

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

# Switch para o usuário não privilegiado
USER $user
