#!/usr/bin/env bash

echo "Running composer"
cp /etc/secrets/.env .env
#composer global require hirak/prestissimo
composer install --working-dir=/var/www/html

echo "Dump autoload..."
php artisan clear-compiled
composer dump-autoload

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate:fresh --seed --force

echo "done deploying"
