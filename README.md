# Laravel Printify

[![Latest Stable Version](https://img.shields.io/packagist/v/ahsan/printify-laravel.svg?style=flat-square)](https://packagist.org/packages/ahsan/printify-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/ahsan/printify-laravel.svg?style=flat-square)](https://packagist.org/packages/ahsan/printify-laravel)
[![License](https.img.shields.io/packagist/l/ahsan/printify-laravel.svg?style=flat-square)](https://packagist.org/packages/ahsan/printify-laravel)

A simple and elegant Laravel package for interacting with the Printify API. This package provides a clean and straightforward way to integrate your Laravel application with Printify, allowing you to manage shops, products, and orders with ease.

## Features

-   Easy to install and configure.
-   A simple, intuitive API for interacting with Printify.
-   Fetch shops, products, and orders.
-   Add new products to your shops.
-   Well-documented and supported.

## Installation

You can install the package via Composer:

```bash
composer require ahsan/printify-laravel
```

## Configuration

Publish the configuration file using the following command:

```bash
php artisan vendor:publish --provider="Ahsan\PrintifyLaravel\PrintifyServiceProvider" --tag="config"
```

This will create a `config/printify.php` file in your project.

Next, add your Printify API token to your `.env` file:

```
PRINTIFY_API_TOKEN=your-api-token
```

## Usage

You can use the `PrintifyService` class to interact with the Printify API.

### Create a PrintifyService Instance

```php
use Ahsan\PrintifyLaravel\PrintifyService;

// You can create an instance directly
$printify = new PrintifyService('your-api-token');

// Or use the service container
$printify = app(PrintifyService::class);
```

### Set the Shop ID

Before you can fetch products or orders, you need to set the shop ID.

```php
$printify->setShopId(123);
```

## Available Methods

Here are the available methods you can use:

### Shops

-   `getShops()`: Fetch all of your shops.

```php
$shops = $printify->getShops();
```

### Products

-   `getProducts()`: Fetch all products for the currently set shop.
-   `addProduct(array $payload)`: Add a new product to the currently set shop.

```php
// Fetch products
$products = $printify->getProducts();

// Add a new product
$payload = [
    "title" => "My new product",
    "description" => "Best product ever",
    "blueprint_id" => 1,
    "print_provider_id" => 1,
    "variants" => [
        [
            "id" => 1,
            "price" => 2000,
            "is_enabled" => true
        ]
    ],
    "print_areas" => [
        [
            "variant_ids" => [1],
            "placeholders" => [
                [
                    "position" => "front",
                    "images" => [
                        [
                            "id" => "5d5d5d5d5d5d5d5d5d5d5d5d",
                            "x" => 0.5,
                            "y" => 0.5,
                            "scale" => 1,
                            "angle" => 0
                        ]
                    ]
                ]
            ]
        ]
    ]
];

$product = $printify->addProduct($payload);
```

### Orders

-   `getOrders()`: Fetch all orders for the currently set shop.

```php
$orders = $printify->getOrders();
```

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

[![Buy Me a Coffee](https://img.shields.io/badge/Buy%20Me%20a%20Coffee-ffdd00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black)](https://www.buymeacoffee.com/ahsanalam)

## Author

-   [Ahsan Alam](https://developerahsan.com)