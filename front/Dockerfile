FROM php:8.1-apache

# Copie des fichiers du projet dans le répertoire par défaut d'Apache
COPY . /var/www/html/

# Attribution des droits nécessaires
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/

# Activation du module de réécriture d'URL d'Apache
RUN a2enmod rewrite

# Exposition du port 80
EXPOSE 80

# Lancement d'Apache
CMD ["apache2-foreground"]