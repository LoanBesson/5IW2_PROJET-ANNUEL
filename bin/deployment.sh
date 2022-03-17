#!/bin/bash
composer install --optimize-autoloader --no-dev
php artisan storage:link
php artisan optimize
php artisan passport:keys --force
php artisan migrate:fresh --force --seed
