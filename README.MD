## How to run locally?

Requirements:
    Composer, PHP, Xampp or Wamp

Steps:
1. Clone repostory
2. Open Terminal and navigate to repository directory
4. Setup Project:
    1. Run command `composer install` to install packages
    2. Run command `php bin/console doctrine:database:create` to create database
    3. Run command `php bin/console doctrine:schema:update --force` to update database tables
    4. Run command `php bin/console doctrine:fixtures:load` to put some fake data to table
5. Run comman `php bin/console server:start` and open http://localhost:8000/books in your browser.