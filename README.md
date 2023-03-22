# Another Logging Helper for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devraeph/laravel-alh.svg?style=flat-square)](https://packagist.org/packages/devraeph/laravel-alh)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/devraeph/laravel-alh/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/devraeph/laravel-alh/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/devraeph/laravel-alh/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/devraeph/laravel-alh/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/devraeph/laravel-alh.svg?style=flat-square)](https://packagist.org/packages/devraeph/laravel-alh)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

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
//coming soon
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-alh-views"
```

## Usage

```php
$aLH = new DevRaeph\ALH();
echo $aLH->echoPhrase('Hello, DevRaeph!');
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
