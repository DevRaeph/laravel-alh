# Another Logging Helper for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devraeph/laravel-alh.svg?style=flat-square)](https://packagist.org/packages/devraeph/laravel-alh)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/devraeph/laravel-alh/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/devraeph/laravel-alh/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/devraeph/laravel-alh/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/devraeph/laravel-alh/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/devraeph/laravel-alh.svg?style=flat-square)](https://packagist.org/packages/devraeph/laravel-alh)

Another small and simple logging package. Mostly I created this for my self and wanted to simplify logging stuff for my ongoing projects.

If anyone can make use of this you're welcome to contribute or open an issue.


## Installation

You can install the package via composer:

```bash
composer require devraeph/laravel-alh
```

You can install the package with:
```bash
php artisan alh:install
```

### OR manually

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-alh-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-alh-config"
```

This is the contents of the published config file:

```php
return [
    'logging' => [
        'in_productions' => env("ALH_LOG_IN_PRODUCTION",false),
        "to_database" => env("ALH_TO_DB",false),
        "to_file" => env("ALH_TO_FILE",true),
        "file_driver" => env("ALH_FILE_DRIVER","local"),
        "file_path" => env("ALH_FILE_PATH","logs_alh"),
        "separate_by_type" => env("ALH_SEPARATE_BY_TYPE",false),
    ],
    'general' => [
        "clear_logs" => false,
        'retention' => env("ALH_LOG_RETENTION",7), //Keep Logs for 7 days by default
    ],

];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-alh-views"
```

## Usage

```php
  /*
   * Uses default mechanism
   * configured in config/alh.php
   * default only toFile and not in production
   */
   
   ALH::error("Error message",new Exception("ex"));
   ALH::warning("Warning message",new Exception("ex"));
   ALH::info("Info message");
   ALH::success("Success message");
   ALH::pending("Pending message");

   /*
   * Override config settings
   */

   /* Log Only to DB */
   ALH::toDB()->error("Error message",new Exception("ex"));
   /* Log only to File */
   ALH::toFile()->error("Error message",new Exception("ex"));
   /* Force Log both */
   ALH::toDB()->toFile()->error("Error message",new Exception("ex"));

   /*
   * Option to set Log issuer like User
   */
   ALH::setIssuer(User::first())->error("Error message",new Exception("ex"));
```

## Access DB Logs
### Dashboard at ``/alh-logs``
#### The gate definition is similar to ``laravel/horizon``.  
#### You can change the defaults at ``app/Providers/ALHMainServiceProvider.php``
```php
protected function gate(): void
{
    Gate::define('viewALH', function (User $user) {
        return in_array($user->email, [
            //
        ]);
    });
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [DevRaeph](https://github.com/DevRaeph)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
