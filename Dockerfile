FROM php:8.2-apache

# Dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    # libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        # pdo_pgsql \
        zip \
        intl

# Activer Apache rewrite (Laravel)
RUN a2enmod rewrite

# Copier le script d'entrée et donner les permissions d'exécution
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Utiliser le script d'entrée comme point d'entrée du conteneur
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]


# Changer le DocumentRoot vers /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copier le projet
COPY . /var/www/html
WORKDIR /var/www/html

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80
