#Fitsy
uses vuez1 style/component library, laravel, and VUEjs


#installation
cd frontend && install<br/>
cd .. npm install<br/>
create database <br/>
update .env<br/>
composer install <br/>
php artisan migrate<br/>
artisan key:generate <br/>

composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"


sudo chmod -R o+rw bootstrap/cache<br/>
sudo chmod -R o+rw storage<br/>
