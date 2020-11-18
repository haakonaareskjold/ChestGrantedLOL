FROM php:8.0-rc-fpm-alpine3.12

ARG USER=nemesis
ARG ID=1000

COPY composer.json composer.lock /var/www/

WORKDIR /var/www/

 # Adding user
RUN adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --no-create-home \
    --uid ${ID} \
    ${USER}

 # Dependencies from apt
RUN apk update && apk add \
    curl \
    unzip

 # Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


USER ${ID}:${ID}

