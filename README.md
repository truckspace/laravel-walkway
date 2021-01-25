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

## About Walkway

Laravel Walkway is a Laravel Socialite provider which makes it super easy for you to allow
your users to authenticate with their Truckspace ID in your Laravel application.

<a name="installation"></a>
## Installation

To get started with Walkway, use the Composer package manager to add the package to your project's dependencies:

```bash
composer require truckspace/laravel-walkway
```

<a name="configuration"></a>
## Configuration

Before using the Walkway socialite provider, you will need to add your credentials to your application's
`config/services.php`configuration file.

```php
'truckspace' => [
    'client_id' => env('TRUCKSPACE_CLIENT_ID'),
    'client_secret' => env('TRUCKSPACE_CLIENT_SECRET'),
    'redirect' => 'http://example.com/callback-url',
],
```

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('truckspace')->redirect();
```

For more information on how to use Laravel Socialite, please visit the
[official documentation](https://laravel.com/docs/8.x/socialite).

## Testing

``` bash
composer test
```

## License

Laravel Walkwat is open-sourced software licensed under the [MIT license](LICENSE.md).
