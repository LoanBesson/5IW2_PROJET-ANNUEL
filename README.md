# Installation du projet

# Api
cd api/ && \
cp .env.example .env && \
composer install && \
sail up -d && \
sail artisan key:generate && \
sail artisan migrate && \
sail artisan db:seed && \
sail artisan passport:install

# Front
cd app/ && \
npm install && \
ng serve --open

# Lien Api
http://localhost/api

# Lien front
http://localhost:4200