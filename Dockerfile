FROM php:8.1-apache

# Installer l'extension mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Installer Composer globalement
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers composer pour profiter du cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances PHP via Composer (sans dev et avec autoloader optimisé)
RUN composer install --no-dev --optimize-autoloader

# Copier le reste des fichiers du projet dans le répertoire de travail
COPY . .

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

# Activer l'affichage des erreurs PHP (désactiver en production)
RUN echo "display_errors=On\n\
    display_startup_errors=On\n\
    error_reporting=E_ALL\n" > /usr/local/etc/php/conf.d/errors.ini

# Exposition du port 80
EXPOSE 80

# Lancement d'Apache
CMD ["apache2-foreground"]
