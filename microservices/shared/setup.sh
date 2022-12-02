composer install
php artisan db:install
php artisan migrate
php artisan db:seed
chmod -R 777 storage/