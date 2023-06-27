FROM composer:2.5 as backend
WORKDIR /app
COPY . /app
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

FROM node:18.16-bullseye-slim as frontend
WORKDIR /app

COPY --from=backend /app /app
RUN npm install && npm run build


FROM php:8.1 as production

ENV APP_ENV=production
ENV APP_DEBUG=false

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_mysql

WORKDIR /app
COPY --from=backend /app /app

COPY .env.example /app/.env

RUN php artisan config:cache && \
    php artisan route:cache && \
    chmod 777 -R /app/storage/

CMD ["bash", "./run.sh"]
EXPOSE 8000
