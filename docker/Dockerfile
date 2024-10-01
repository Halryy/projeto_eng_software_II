FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    libxml2-dev \
    libonig-dev \
    libpq-dev \
    libmcrypt-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    libxslt-dev \
    cmake

RUN MAKEFLAGS="-j $(nproc)" pecl install -f APCu-5.1.22
RUN MAKEFLAGS="-j $(nproc)" pecl install -f mcrypt-1.0.5
RUN MAKEFLAGS="-j $(nproc)" pecl install -f mongodb-1.15.0

RUN docker-php-ext-enable apcu mcrypt mongodb
RUN docker-php-ext-install -j$(nproc) curl intl mbstring mysqli opcache sockets xml xsl zip
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install -j$(nproc) pdo pdo_pgsql pgsql

RUN php -m

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl http://download.osgeo.org/geos/geos-3.12.2.tar.bz2 -o geos.tar.bz2 \
    && tar -xjvf geos.tar.bz2 \
    && cd geos-3.12.2/ \
    && ./configure --prefix=/usr \
    && make -j$(nproc) \
    && make install \
    && cd .. \
    && rm -rf geos-3.12.2 \
    && rm geos.tar.bz2

RUN git clone https://git.osgeo.org/gitea/geos/php-geos.git \
    && cd php-geos \
    && ./autogen.sh \
    && ./configure \
    && make

RUN mv php-geos/modules/geos.so $(php-config --extension-dir)/geos.so

RUN echo "extension=geos.so" > /usr/local/etc/php/conf.d/geos.ini

WORKDIR /var/www

COPY . /var/www

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

CMD ["php-fpm"]
