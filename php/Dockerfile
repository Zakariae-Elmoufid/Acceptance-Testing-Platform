FROM php:8.4-apache

# Installer les dépendances nécessaires pour PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev

# Installer les dépendances nécessaires pour PostgreSQL et autres outils
RUN apt-get update && apt-get install -y \
    libpq-dev git zip unzip \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs


