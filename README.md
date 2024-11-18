docker compose up -d --build

docker exec -ti nux-php-1 sh

php artisan migrate

Go to http://localhost
