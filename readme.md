## Features

* Books list
* Sort by Title/Year/Author/Genre
* Search by Title/Year/Author/Genre
* Pagination
* Single book page
* Auto-seeding database on setup

## Built & tested with
* Laravel 5.4
* Bootstrap 4
* jQuery 3.1
* PHP 7.0

## Windows setup

1. Download dependencies
    ```bash
    composer install
    ```

2. Create .env file
    ```bash
    copy .env.example .env
    ```

3. Generate key
    ```bash
    php artisan key:generate
    ```
4. Migrate database
    ```bash
    php artisan migrate
    ```

5. Seed database (books data crawled from knygos[dot]lt (for learning purposes only))
    ```bash
    php artisan db:seed
    ```
    
