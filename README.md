## Installation du projet
<br>

---
    
    cp .env.example .env && \
    composer install && \
    sail up -d && \
    sail artisan key:generate && \
    sail artisan migrate && \
    sail artisan db:seed && \
    sail artisan passport:install

### Meilisearch
sail artisan scout:import "App\Models\Property"

#### En cas de problème de token
    sail artisan passport:keys --force && \
    sail artisan passport:install --force
<br>

---
### Liens
---

#### Adminer : http://localhost:81
#### Api : http://localhost/api
#### Front : https://github.com/Doriangue/frontPA
