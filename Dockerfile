FROM php:7.4.4-cli

ENV XLS_DIR=/local/

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev

RUN docker-php-ext-install gd zip

WORKDIR /src
COPY ./ /src

RUN composer install --no-dev

CMD php bin/console app:xls2xlsx --help
