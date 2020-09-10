# a simple laravel package to create chats rooms and channels

[![Latest Version on Packagist](https://img.shields.io/packagist/v/theprofessor/laravelchatchannels.svg?style=flat-square)](https://packagist.org/packages/theprofessor/laravelchatchannels)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/theprofessor/laravelchatchannels/run-tests?label=tests)](https://github.com/theprofessor/laravelchatchannels/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/theprofessor/laravelchatchannels.svg?style=flat-square)](https://packagist.org/packages/theprofessor/laravelchatchannels)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

Learn how to create a package like this one, by watching our premium video course:

[![Laravel Package training](https://spatie.be/github/package-training.jpg)](https://laravelpackage.training)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require theprofessor/laravelchatchannels
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="TheProfessor\Laravelchatchannels\LaravelchatchannelsServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="TheProfessor\Laravelchatchannels\LaravelchatchannelsServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$laravelchatchannels = new TheProfessor\Laravelchatchannels();
echo $laravelchatchannels->echoPhrase('Hello, TheProfessor!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [EyadHamza](https://github.com/EyadHamza)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
