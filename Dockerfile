FROM php:8.1-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install mysqli zip \
    && docker-php-ext-enable mysqli

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie des fichiers du projet dans le répertoire par défaut d'Apache
COPY . /var/www/html/

# Attribution des droits nécessaires
RUN chown -R www-data:www-data /var/www/html/ && \
    find /var/www/html/ -type d -exec chmod 755 {} \; && \
    find /var/www/html/ -type f -exec chmod 644 {} \;

# Activation du module de réécriture d'URL d'Apache
RUN a2enmod rewrite

# Configuration d’Apache pour autoriser les fichiers .htaccess
RUN echo "<Directory /var/www/html/>\n\
    AllowOverride All\n\
    </Directory>" > /etc/apache2/conf-available/override.conf && \
    a2enconf override

# Activer l'affichage des erreurs PHP
RUN echo "display_errors=On\n\
    display_startup_errors=On\n\
    error_reporting=E_ALL\n" > /usr/local/etc/php/conf.d/errors.ini

# Installer les dépendances PHP si un composer.json existe
WORKDIR /var/www/html/
RUN if [ -f "composer.json" ]; then composer install --no-dev; fi

# Exposition du port 80
EXPOSE 80

# Lancement d'Apache
CMD ["apache2-foreground"]
