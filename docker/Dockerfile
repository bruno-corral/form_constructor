FROM php:8.3-apache
 
# Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
 
# Dependências & Supervisord
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/cacert.pem /etc/ssl/certs/cacert.pem
COPY ./docker/php.ini /usr/local/etc/php/php.ini
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf
 
RUN apt-get update && apt-get install -y \
    systemd \
    supervisor \
    libzip-dev \
    git \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unixodbc-dev \
    libssl-dev \
    libmagic-dev \
    gnupg2 \
	lsb-release \
    npm \
    && apt-get clean all
 
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs
 
RUN npm install -g npm
 
# # Instalação do Microsoft ODBC Driver para SQL Server e o driver PHP sqlsrv
# RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
#     && curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
#     && apt-get update \
#     && ACCEPT_EULA=Y apt-get install -y msodbcsql18 \
#     && ACCEPT_EULA=Y apt-get install -y mssql-tools18 \
#     && apt-get install -y unixodbc-dev \
#     && pecl install sqlsrv pdo_sqlsrv \
#     && docker-php-ext-enable sqlsrv pdo_sqlsrv
 
# Instalação das extensões do PHP
RUN chmod 644 /etc/ssl/certs/cacert.pem && update-ca-certificates \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install mysqli pdo pdo_mysql zip exif intl gd bcmath fileinfo  \
    && docker-php-ext-enable pdo_mysql fileinfo \
    && a2enmod rewrite
 
#postgres
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && docker-php-ext-enable pgsql pdo_pgsql
 
#Instalando GDAL
#RUN apt-get update && apt-get install -y \
#    gdal-bin \
#    python3-gdal \
#    libgdal-dev \
#    && apt-get clean all
 
 
# Diretório do projeto
WORKDIR "/app"
 
# Copia os arquivos
COPY . .
 
# Install
RUN composer install --prefer-dist
 
RUN rm -rf node_modules/ package-lock.json \
    && npm cache clean --force \
    && npm install \
    && npm run build
 
# Cache icons
#RUN php artisan icons:cache
#RUN php artisan config:cache
#RUN php artisan route:cache
#RUN php artisan event:cache
#RUN php artisan view:cache
#RUN php artisan optimize
 
# Storage Link
#RUN php artisan storage:link
 
# Permissões do diretório
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app
 
# Start Supervisord
CMD ["/usr/bin/supervisord"]