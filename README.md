Create a database locally named directaxis utf8_general_ci
Download composer https://getcomposer.org/download/
Pull Laravel/php project from git provider.
fill the database information in .env file.
Open the console and cd your project root directory
Run composer install or php composer.phar install
Run php artisan key:generate
Run php artisan migrate
Run php artisan db:seed to run seeders, if any.
Run php artisan serve

