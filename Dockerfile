FROM dunglas/frankenphp:php8.4 AS base

RUN apt-get update && apt-get install -y unzip git \
    && curl -O https://getcomposer.org/installer \
    && php installer --filename=composer --install-dir=/usr/local/bin \
    && composer global require laravel/installer \
    && curl -fsSL https://deb.nodesource.com/setup_22.x -o nodesource_setup.sh \
    && bash nodesource_setup.sh \
    && apt-get install -y nodejs \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

WORKDIR /url-shortener


FROM base AS build
COPY . .
RUN GIT_REPO_URL="" composer install && npm ci && npm run build


FROM dunglas/frankenphp:php8.4-alpine AS production
COPY --from=build /url-shortener .
ENV GIT_REPO_URL=""
RUN php artisan migrate --force -n
# RUN GIT_REPO_URL="" php artisan optimize
