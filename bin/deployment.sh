#!/bin/bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan storage:link
php artisan optimize
php artisan passport:keys --force
php artisan migrate:fresh --force --seed
