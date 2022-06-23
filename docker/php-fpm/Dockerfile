FROM php:8.1.1-fpm
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

ENV TZ=Europe/Warsaw
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
        zip \
        git \
        libzip-dev \
        libicu-dev

RUN git clone --depth 1 --branch v1.7.0 https://github.com/edenhill/librdkafka.git  \
    && cd librdkafka \
    && ./configure \
    && make \
    && make install

RUN pecl channel-update pecl.php.net \
    && pecl install rdkafka

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install zip intl && docker-php-ext-enable rdkafka


