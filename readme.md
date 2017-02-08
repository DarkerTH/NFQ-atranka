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

5. Seed database
    ```bash
    php artisan seed
    ```
    
Tested with PHP 7.0.
