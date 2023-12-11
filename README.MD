## How to run locally?

Requirements:
    - Composer
    - PHP

Steps:
    1. Clone repostory
    2. Open Terminal and navigate to repository directory
    3. Run command `composer install`
    4. Run command `php bin/console doctrine:database:create` to create database
    5. Run command `php bin/console doctrine:schema:update --force` to update database tables
    6. Run command `php bin/console doctrine:fixtures:load` to put some fake data to table
    7. Run comman `php bin/console server:start` and open http://localhost:8000/books in your browser.