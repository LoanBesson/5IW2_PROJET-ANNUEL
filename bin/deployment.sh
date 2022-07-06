#!/bin/bash
apt install -y php-redis
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan storage:link
php artisan optimize
php artisan migrate:fresh --force
php artisan passport:install
php artisan jwt:secret
