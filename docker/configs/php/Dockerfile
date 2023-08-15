FROM composer:2.2.6 as composer-image
ARG WORKDIR
WORKDIR ${WORKDIR}
COPY . ${WORKDIR}
RUN composer install --no-dev --ignore-platform-reqs

FROM php:8.2-fpm
ARG WORKDIR
WORKDIR ${WORKDIR}

RUN apt-get -y update && apt-get -y install git unzip rsync
RUN pecl install xdebug && docker-php-ext-enable xdebug;
COPY ./docker/configs/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY --from=composer-image ${WORKDIR} ${WORKDIR}

CMD php-fpm
EXPOSE 9000
