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

# Corriger le conflit MPM : désactiver mpm_prefork dans les fichiers de conf
RUN sed -i '/mpm_prefork/d' /etc/apache2/mods-enabled/*.conf && \
    sed -i '/mpm_prefork/d' /etc/apache2/mods-available/*.conf || true && \
    a2dismod mpm_prefork || true && \
    a2enmod mpm_event

# Activer Apache rewrite (Laravel)
RUN a2enmod rewrite

# Fixer l'erreur "More than one MPM loaded"
RUN a2dismod mpm_prefork && a2enmod mpm_event

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
