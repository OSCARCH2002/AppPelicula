# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias para Laravel y Composer
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Instala Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copia el código de la app
COPY . /var/www/html

# Da permisos a storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Copia el archivo .env.example a .env si no existe
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Genera la clave de la app (ignora error si ya existe)
RUN php artisan key:generate || true

# Expone el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]