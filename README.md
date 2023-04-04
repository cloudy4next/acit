# ACIT

ACIT for ............

## References

-   Backpack for Laravel Documentation: https://backpackforlaravel.com/docs
-   Settings Addon: https://github.com/Laravel-Backpack/Settings
-   Permission Manager Addon: https://github.com/Laravel-Backpack/PermissionManager
-   Backstrap Theme: https://backstrap.net

## Coding Guideline

-   PHP: [PSR 1](https://www.php-fig.org/psr/psr-1/), [PSR-2](https://www.php-fig.org/psr/psr-2/), [PSR-12](https://www.php-fig.org/psr/psr-12/)
-   Laravel: https://spatie.be/guidelines/laravel-php
-   Javascript: https://standardjs.com/

## Installation(ubuntu)

0.Install ffmpeg:

```
sudo apt install ffmpeg

```

1. Checkout the repository:

```
git clone git@github.com:cloudy4next/acit.git
```

2. Install composer dependencies:

```
composer install
```

3. Run migration:

```
php artisan migrate
```

4. Start the built-in webserver (or use Apache/Nginix):

```
php artisan serve
```

5. Browse the admin panel and use the registration to create a user: http://127.0.0.1:8000/admin

#testing
composer require minuteoflaravel/laravel-audio-video-validator
