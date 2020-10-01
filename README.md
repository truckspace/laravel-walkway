# Laravel Walkway

[![Latest Version on Packagist](https://img.shields.io/packagist/v/truckspace/laravel-walkway.svg?style=flat-square)](https://packagist.org/packages/truckspace/laravel-walkway)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/truckspace/laravel-walkway/run-tests?label=tests)](https://github.com/truckspace/laravel-walkway/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/truckspace/laravel-walkway.svg?style=flat-square)](https://packagist.org/packages/truckspace/laravel-walkway)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require truckspace/laravel-walkway
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Truckspace\Walkway\WalkwayServiceProvider" --tag="walkway-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Truckspace\Walkway\WalkwayServiceProvider" --tag="walkway-config"
```

This is the contents of the published config file:

```php
return [
    
    'columns' => [

        // The name of the column used to store the users Truckspace ID
        'id' => 'truckspace_id',

        // The name of the column used to store the users tokens
        'tokens' => 'truckspace_tokens',

        // Determines if the contents of the tokens field is encrypted
        'encrypt' => true,

    ],
    
    'cache' => [
    
        // The name of the cache store (this will use the default cache out of the box)
        'store' => null,

        // The prefix for the cache key followed by the users ID
        'prefix' => 'truckspace-user:',

        // The ttl (in seconds) of how long the data should be cached
        'ttl' => 1800,

    ],

];
```

## Using Laravel Walkway

``` php

```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
