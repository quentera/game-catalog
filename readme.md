docker exec -it game-catalog-php chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
docker exec -it game-catalog-php chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
