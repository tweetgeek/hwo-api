#!/bin/bash
php artisan queue:work &
php artisan migrate
php artisan db:seed
php artisan optimize:clear
php artisan serve --host 0.0.0.0
