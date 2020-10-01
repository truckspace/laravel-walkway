<p align="center"><img src="https://raw.githubusercontent.com/truckspace/art/68646a1f845c6f9a8c18574fe28cdcc73b0a8515/laravel-walkway/logo.svg"></p>

<p align="center">
    <a href="https://github.com/truckspace/laravel-walkway/actions">
        <img src="https://github.com/truckspace/laravel-walkway/workflows/Tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/truckspace/laravel-walkway">
        <img src="https://poser.pugx.org/truckspace/laravel-walkway/d/total.svg" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/truckspace/laravel-walkway">
        <img src="https://poser.pugx.org/truckspace/laravel-walkway/v/stable.svg" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/truckspace/laravel-walkway">
        <img src="https://poser.pugx.org/truckspace/laravel-walkway/license.svg" alt="License">
    </a>
</p>


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
