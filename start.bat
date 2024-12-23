%systemDrive%\xampp\mysql\bin\mysql -uroot -e "CREATE DATABASE IF NOT EXISTS car_rental;"

call composer install

call php artisan migrate:fresh --seed

call php artisan key:generate

call php artisan serve
