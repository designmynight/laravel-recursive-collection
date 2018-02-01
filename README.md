Laravel Recursive Collection
===============

[![Latest Stable Version](http://img.shields.io/github/release/designmynight/laravel-recursive-collection.svg)](https://packagist.org/packages/designmynight/laravel-recursive-collection) [![Total Downloads](http://img.shields.io/packagist/dm/designmynight/laravel-recursive-collection.svg)](https://packagist.org/packages/designmynight/laravel-recursive-collection)

A service provider to add support for for converting nested arrays and associve arrays into laravel collections

Table of contents
-----------------
* [Installation](#installation)
* [Example](#example)

Installation
------------

Installation using composer:

```sh
composer require designmynight/laravel-recursive-collection
```

### Laravel version Compatibility

 Laravel  | Package
:---------|:----------
 5.5.x    | 1.0.x

And add the service provider in `config/app.php`:

```php
DesignMyNight\Laravel\RecursiveCollectionServiceProvider::class,
```

For usage with [Lumen](http://lumen.laravel.com), add the service provider in `bootstrap/app.php`.

```php
$app->register(DesignMyNight\Laravel\RecursiveCollectionServiceProvider::class);
```

Example
------------

```
$data = [
    [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
        'bookings' => [
            [
                'venue' => 'Venue A',
                'date' => '2000-01-01'
                'guests' => 2
            ],
            [
                'venue' => 'Venue B',
                'date' => '2001-01-01'
                'guests' => 2
            ],
        ],
    ],
];

$collection = (new Collection($data))->recursive();
$collection = collect($data)->recursive(); // Shorthand
```
