composer install
php artisan db:install
php artisan migrate
php artisan db:seed
php artisan db:fix_sequences
chmod -R 777 storage/