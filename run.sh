#!/bin/bash
php artisan config:cache
php artisan route:cache
php artisan queue:work &
php artisan migrate --force
php artisan db:seed --force
php artisan optimize:clear
php artisan serve --host 0.0.0.0
