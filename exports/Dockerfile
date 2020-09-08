FROM php:7.4-fpm-alpine AS base
RUN mkdir -p /var/www/html
RUN docker-php-ext-install pdo_mysql opcache
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

COPY ./docker/php/php.ini "$PHP_INI_DIR/php.ini"
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage
RUN /usr/bin/composer install \
    && /usr/bin/composer dumpautoload -n -d /var/www/html \
    && /usr/bin/composer clear-cache

FROM base AS php
ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]
CMD ["php-fpm"]

FROM base AS artisan
ENTRYPOINT ["/usr/local/bin/php /var/www/html/artisan"]
CMD ["optimize"]
