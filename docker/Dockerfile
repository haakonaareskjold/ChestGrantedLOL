FROM php:8.0-rc-fpm-alpine3.12
WORKDIR /app/
ARG USER=nemesis
ARG ID=1000

RUN adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --no-create-home \
    --uid ${ID} \
    ${USER}


USER ${ID}:${ID}
