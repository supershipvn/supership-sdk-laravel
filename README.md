# SuperShip SDK for Laravel

<a href="https://packagist.org/packages/supershipvn/supership-sdk-laravel"><img src="https://img.shields.io/packagist/dt/supershipvn/supership-sdk-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/supershipvn/supership-sdk-laravel"><img src="https://img.shields.io/packagist/v/supershipvn/supership-sdk-laravel" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/supershipvn/supership-sdk-laravel"><img src="https://img.shields.io/github/license/supershipvn/supership-sdk-laravel" alt="License"></a>
</p>

## Introduction

Using the **SuperShip SDK for Laravel**, developers can easily integrate [SuperShip APIs](https://docs.developers.supership.vn) into their Laravel codebase, enabling businesses to automate and scale their shipping operations.

## Features

Some of the SuperShip APIs available include:
* Areas API: This API allows developers to retrieve a list of provinces, districts, and communes supported by SuperShip for the pickup, delivery, and return of goods.
* Auth API: This API allows developers to register a new user and retrieve a token via username and password.
* Orders API: This API allows developers to retrieve shipping rates, create a new order, retrieve order information, obtain order status lists, and generate shipping labels.
* Warehouses API: This API allows developers to create a new warehouse, edit the current warehouse, and retrieve information on all warehouses.
* Webhooks API: This API allows developers to register a new webhook, edit the current webhook, and retrieve registered webhooks.

Please check [SuperShip API Documentation](https://docs.developers.supership.vn) for more details.

## API Documentation

Documentation for SuperShip APIs can be found on the [API Documentation Website](https://docs.developers.supership.vn).

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require supershipvn/supership-sdk-laravel
```

The package will automatically register itself.

You can optionally publish the config file with:

```bash
php artisan vendor:publish --provider="SuperShipVN\SuperShip\SuperShipServiceProvider" --tag="supership-config"
```

***The following steps are necessary only if your Laravel version is lower than 5.5***

- To add the service provider, update the `config/app.php` file by including an entry for it.

```php
'providers' => [
	// ...
	SuperShipVN\SuperShip\SuperShipServiceProvider::class
];
```

- To register the class alias, add an entry for it in the aliases section.

```php
'aliases' => [
	// ...
	'SuperShip' => SuperShipVN\SuperShip\Facades\SuperShip::class
];
```

## Configuration

To enter your *SuperShip API Token*, update the `.env` file with the following information:
```
SUPERSHIP_API_TOKEN=xxxxxxxxxxxxxxxxxxxx
```

## Usage

### Orders API

#### Create Order

To create a new order, call the `createOrder` method using the following syntax:
    
```php
use SuperShip;

$params = [
    'pickup_phone' => '0989999999',
    'pickup_address' => '45 Nguyễn Chí Thanh',
    'pickup_commune' => 'Phường Ngọc Khánh',
    'pickup_district' => 'Quận Ba Đình',
    'pickup_province' => 'Thành phố Hà Nội',
    'name' => 'Trương Thế Ngọc',
    'phone' => '0945900350',
    'email' => null,
    'address' => '35 Trương Định',
    'province' => 'Thành phố Hồ Chí Minh',
    'district' => 'Quận 3',
    'commune' => 'Phường 6',
    'amount' => '220000',
    'value' => null,
    'weight' => '200',
    'payer' => '1',
    'service' => '1',
    'config' => '1',
    'soc' => 'KAN7453535',
    'note' => 'Giao giờ hành chính',
    'product_type' => '2',
    'products' => [
        [
            'sku' => 'P899234',
            'name' => 'Tên Sản Phẩm 1',
            'price' => 200000,
            'weight' => 200,
            'quantity' => 1,
        ],
        [
            'sku' => 'P899789',
            'name' => 'Tên Sản Phẩm 2',
            'price' => 250000,
            'weight' => 300,
            'quantity' => 2,
        ],
    ]
];

SuperShip::createOrder($params);
```

Optionally, you can retrieve the Order Code using the following method:

```php
$order = SuperShip::createOrder($params);
return $order['results']['code'];
```

#### Get Single Order Info

To retrieve single order, call the `getOrderInfo` method using the following syntax:

```php
$supershipOrderCode = 'SUPERSHIP_ORDER_CODE';
SuperShip::getOrderInfo($supershipOrderCode);
```

#### Get All Order Statuses

To retrieve all order statuses, call the `getOrderStatuses` method using the following syntax:

```php
SuperShip::getOrderStatuses();
```

#### Create Print Token

To obtain a new token for label printing, call the `createPrintToken` method using the following syntax:

```php
$params = [
    'code' => [
        'SUPERSHIP_ORDER_CODE_1',
        'SUPERSHIP_ORDER_CODE_2'
    ]
];

SuperShip::createPrintToken($params);
```

#### Get Print Link

To retrieve the print link for a print token, call the `getPrintLink` method using the following syntax:

```php
$printToken = '49ef6620-423e-11e9-b019-b71407a43f47';
$labelSize = 'K46';

SuperShip::getPrintLink($printToken, $labelSize);
```
### Warehouses API

#### Get All Warehouses

To retrieve all warehouses, call the `getWarehouses` method using the following syntax:

```php
SuperShip::getWarehouses();
```

#### Create Warehouse

To create a new warehouse, call the `createWarehouse` method using the following syntax:

```php
$params = [
    'name' => 'Kho HBT',
    'phone' => '0989999888',
    'contact' => 'Trần Cao Cường',
    'address' => '47 Lê Lợi',
    'province' => 'Thành phố Hồ Chí Minh',
    'district' => 'Quận Tân Bình',
    'district' => 'Phường 13',
    'primary' => '1'
];

SuperShip::createWarehouse($params);
```

#### Update Warehouse

To edit the current warehouse, call the `editWarehouse` method using the following syntax:

```php
$params = [
    'code' => 'WLKGT07050',
    'name' => 'Kho Hai Bà Trưng',
    'phone' => '0989999888',
    'contact' => 'Dương Mạnh Quân'
];

SuperShip::editWarehouse($params);
```

### Webhooks API

#### Get All Webhooks

To retrieve all webhooks, call the `getWebhooks` method using the following syntax:

```php
SuperShip::getWebhooks();
```

#### Register Webhook

To register a new webhook, call the `registerWebhook` method using the following syntax:

```php
$partnerUrl = 'https://example.com/listen/supership';

SuperShip::registerWebhook($partnerUrl);
```

### Auth API

#### Create User

To create a new user, call the `createUser` method using the following syntax:

```php
$params = [
    'project' => 'HMN Store',
    'name' => 'Hoàng Mạnh Nam',
    'phone' => '0989998888',
    'email' => 'hmn.store@gmail.com',
    'password' => '323423',
    'partner' => 'lPxLuxfiTotCyZ1ZnQjMepUL24HLd05ybNBhVGFN'
];

SuperShip::createUser($params);
```

#### Retrieve Token

To retrieve a token via username and password, call the `retrieveToken` method using the following syntax:

```php
$params = [
    'client_id' => 'AZN6QUo40w',
    'client_secret' => 'C4fFVeFPkISEDQ8acNo9oSHUd8yIGuvoLWJdX9zY',
    'username' => 'hmn.store@gmail.com',
    'password' => '323423',
    'partner' => 'lPxLuxfiTotCyZ1ZnQjMepUL24HLd05ybNBhVGFN'
];

SuperShip::retrieveToken($params);
```

### Areas API

#### Get All Provinces

To retrieve all provinces, call the `getProvinces` method using the following syntax:

```php
SuperShip::getProvinces();
```

#### Get All Districts

To retrieve all districts, call the `getDistricts` method using the following syntax:

```php
$provinceCode = '79';

SuperShip::getDistricts($provinceCode);
```

#### Get All Communes

To retrieve all communes, call the `getCommunes` method using the following syntax:

```php
$districtCode = '777';

SuperShip::getCommunes($districtCode);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

## Contributing

Thank you for considering contributing to **SuperShip SDK for Laravel**! The contribution guide can be found in our [contributing guidelines](CONTRIBUTING.md).

## Security

If you've found a bug regarding security please mail [supertek@supership.vn](mailto:supertek@supership.vn) instead of using the issue tracker.

## Credits

- [SuperShip](https://github.com/supershipvn)
- [All Contributors](../../contributors)

## License

**SuperShip SDK for Laravel** is open-sourced software licensed under the [MIT license](LICENSE).