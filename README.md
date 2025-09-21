# Printify Laravel

A Laravel package for interacting with the Printify API.

## Installation

You can install the package via composer:

```bash
composer require ahsan/printify-laravel
```

You must publish the configuration file:

```bash
php artisan vendor:publish --provider="Ahsan\PrintifyLaravel\PrintifyServiceProvider" --tag="config"
```

This will create a `config/printify.php` file in your project.

Add your Printify API token to your `.env` file:

```
PRINTIFY_API_TOKEN=your-api-token
```

## Usage

You can use the `PrintifyService` class to interact with the Printify API.

### Create PrintifyService instance

```php
use Ahsan\PrintifyLaravel\PrintifyService;

$printify = new PrintifyService('your-api-token');
```

### Fetch shops

```php
$shops = $printify->getShops();
```

### Set shop ID

```php
$printify->setShopId(123);
```

### Fetch products

```php
$products = $printify->getProducts();
```

### Add a product

```php
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

### Fetch orders

```php
$orders = $printify->getOrders();
```
