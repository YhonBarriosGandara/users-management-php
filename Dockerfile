# ================================================================
# Dockerfile para Aplicación PHP 8.2 con Apache
# Asignatura: Desarrollo Web — Unidad 3
# Arquitectura Hexagonal + DDD + CQRS
# ================================================================

FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones de PHP necesarias para MySQL
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite para el Front Controller
RUN a2enmod rewrite

# Configurar Apache para que el DocumentRoot apunte a la carpeta /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar el código fuente
COPY . .

# Permisos para el usuario www-data
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
