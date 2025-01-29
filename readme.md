docker exec -it laravel-ticket-system-db bash #to access to the db container

mysql -u zimou -p # to access to the database

zimou123   #password

docker exec -it laravel-ticket-system-app bash #to access to the app env


php artisan migrate      #to push the migration

docker-compose up --build      #to build and run the app

#to access to the data files
chmod -R 775 /var/www/html/my-laravel-app/storage /var/www/html/my-laravel-app/bootstrap/cache

chown -R www-data:www-data /var/www/html/my-laravel-app/storage /var/www/html/my-laravel-app/bootstrap/cache
ls -ld /var/www/html/my-laravel-app/storage /var/www/html/my-laravel-app/bootstrap/cache

chown -R www-data:www-data /var/www/html/my-laravel-app

chcon -R -t httpd_sys_rw_content_t /var/www/html/my-laravel-app/storage /var/www/html/my-laravel-app/bootstrap/cache
chmod -R 755 /var/www/html/my-laravel-app/public

docker exec -it laravel-ticket-system-app php artisan key:generate
php artisan db:seed
php artisan migrate:rollback
