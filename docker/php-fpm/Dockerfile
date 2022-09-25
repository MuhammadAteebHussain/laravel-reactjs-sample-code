FROM php:8.1.0-fpm

#xdebug profiler directory
RUN echo xdebug.profiler_enable_trigger = 1 > /usr/local/etc/php/php.ini \
    && echo xdebug.profiler_aggregate = 1 > /usr/local/etc/php/php.ini \
    && echo xdebug.profiler_append = 1 > /usr/local/etc/php/php.ini

RUN apt-get update && apt-get install -y \
        curl \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        git \
        zip \
        unzip \
        librabbitmq-dev \
        libssh-dev \
        libpq-dev \
        wget \
    && rm -rf /var/lib/apt/lists/* \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install opcache \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install sockets \
    && docker-php-ext-enable sockets \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql \
    && docker-php-ext-install -j$(nproc) iconv

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

#install apc cache
RUN pecl install apcu \
    && echo extension=apcu.so > /usr/local/etc/php/conf.d/apcu.ini

WORKDIR /server/http
