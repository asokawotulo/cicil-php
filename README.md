# Cicil.co.id PHP Library

This library is an abstraction of Cicil's API for applications written with PHP.

## Table of Contents
- [Links](#links)
- [Installation](#installation)
- [Usage](#usage)
  - [Initialization](#initialization)
  - [Create Purchase Order](#create-purchase-order)
  - [Create Notification](#create-notification)
    - [Create Shipping Notification](#create-shipping-notification)
    - [Create Delivered Notification](#create-delivered-notification)
    - [Create Shipping Notification](#create-shipping-notification-1)
  - [Create Installment Simulation](#create-installment-simulation)
  - [Verify Callback Token](#verify-callback-token)

## Links
- [Main documentation](https://docs.cicil.app/)

## Installation
```bash
composer require asokawotulo/cicil-php
```

## Usage
### Initialization
```php
use Cicil\Cicil;

Cicil::setEnv(Cicil::PRODUCTION); // or Cicil::SANDBOX
Cicil::setApiKey('xxxxxxxx');
Cicil::setMerchantId('xxxxxxxx');
Cicil::setMerchantSecret('xxxxxxxx');
```

### Create Purchase Order
```php
use Cicil\Cicil;

$purchaseOrderData = [
    'transaction' => [
        'total_amount' => 13119000,
        'transaction_id' => 'ORD10111808',
        'item_list' => [
            [
                'item_id' => 'SKU101112',
                'type' =>  'product',
                'name' => 'Notebook CICIL C12',
                'price' => 12999000,
                'category' => 'laptop',
                'url' => 'https://www.tokocicil.com/product/sku101112',
                'quantity' => 1,
                'seller_id' => 'tokocicil-official'
            ],
            [
                'item_id' => 'SKU131415',
                'type' =>  'product',
                'name' => 'Sticker Aja',
                'price' => 60000,
                'category' => 'accessories',
                'url' => 'https://www.tokocicil.com/product/sku131415',
                'quantity' => 2
            ],
            [
                'item_id' => 'insurance',
                'type' =>  'fee',
                'name' => 'Insurance Fee',
                'price' => 5000,
                'quantity' => 1
            ],
            [
                'item_id' => 'shipment_cost',
                'type' =>  'shipment_cost',
                'name' => 'Shipping Fee',
                'price' => 45000,
                'quantity' => 1
            ],
            [
                'item_id' => 'CICIL1212',
                'type' =>  'discount',
                'name' => 'Promo Harbolnas CICIL',
                'price' => -50000,
                'quantity' => 1
            ]
        ],
    ],
    'buyer' => [
        'fullname' => 'John Doe',
        'email' => 'john.doe@mail.com',
        'phone' => '085322984060',
        'address' => 'Jl. Sd Inpres RT.003/RW.006 No.174A 13950 Cakung, Pulogebang',
        'city' => 'Jakarta Timur',
        'district' => 'JK',
        'postal_code' => '11630',
        'company' => 'Cicil',
        'country' => 'ID'
    ],
    'shipment' => [
        'shipment_provider' => 'Flat rate',
        'shipping_price' => 40000,
        'shipping_tax' => 0,
        'name' => 'John Doe',
        'address' => 'Jl. Sd Inpres RT.003/RW.006 No.174A 13950 Cakung, Pulogebang',
        'city' => 'Jakarta Timur',
        'district' => 'Jakarta Timur',
        'postal_code' => '11630',
        'phone' => '085322984060',
        'company' => 'Cicil',
        'country' => 'ID'
    ],
    'push_url' => 'https://api.tokocicil.com/update',
    'redirect_url' => 'https://toko.cicil.dev',
];

$response = Cicil::createPurchaseOrder($purchaseOrderData);

echo $response['url'];
```

### Create Notification
#### Create Shipping Notification
```php
use Cicil\Cicil;
use Cicil\Enums\PurchaseOrderStatusEnum;

$notifcationData = [
    'po_no' =>  'PO191219-162490',
    'po_status' =>  PurchaseOrderStatusEnum::SHIPPING,
    'transaction_id' => 'ORD10111808',
    'shipment_provider' =>  'JNE',
    'shipment_no' =>  '14045'
];
Cicil::createNotification($notificationData);
```

#### Create Delivered Notification
```php
use Cicil\Cicil;
use Cicil\Enums\PurchaseOrderStatusEnum;

$notifcationData = [
    'po_no' =>  'PO191219-162490',
    'po_status' =>  PurchaseOrderStatusEnum::DELIVERED,
    'transaction_id' => 'ORD10111808'
];
Cicil::createNotification($notificationData);
```

#### Create Shipping Notification
```php
use Cicil\Cicil;
use Cicil\Enums\PurchaseOrderStatusEnum;

$notifcationData = [
    'po_no' =>  'PO191219-162490',
    'po_status' =>  PurchaseOrderStatusEnum::CANCEL,
    'transaction_id' => 'ORD10111808',
    'reason' =>  'wrong product'
];
Cicil::createNotification($notificationData);
```

### Create Installment Simulation
```php
use Cicil\Cicil;

$simulationData = [
    'price' => 5000000,
    'dp' => 1000000, // 0 for minimum down payment amount
    'tenure' => 12, // 0 for default tenure duration
];
Cicil::createInstallmentSimulation($simulationData);
```

### Verify Callback Token
```php
use Cicil\Common\Utils as CicilUtils;
use Cicil\Cicil;

$request = [
    'headers' => [
        'authorization' => 'Basic xxxx',
        'date' => 'Tue, 11 Jan 2022 19:42:43 GMT',
    ],
];

$apiKey = Cicil::getApiKey();
$merchantId = Cicil::getMerchantId();
$merchantSecret = Cicil::getMerchantSecret();
$date = $request['headers']['date'];

$requestToken = str_replace('Basic ', '', $request['headers']['authorization'])
$generatedToken = CicilUtils::generateAuthorizationToken(
    $apiKey,
    $merchantId,
    $merchantSecret,
    $date,
);

if ($generatedToken != $requestToken) {
    throw new Error('Authorization token invalid');
}
```