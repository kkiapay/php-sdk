# KKIAPAY PHP-SDK

## Raw Files

```bash
    git clone https://github.com/kkiapay/php-sdk.git
```


 
## Installing

  

Using composer:
  

```bash

    composer require kkiapay/kkiapay-php

```

  

## Request to retrieve transactions 

#### EXAMPLE
```php
    $kkiapay = new \Kkiapay\Kkiapay($public_key, $private_key, $secret, $sandbox=false);
    $kkiapay->verifyTransaction($transaction_id);
```

## Request to revert transaction 

#### EXAMPLE

```php
    $kkiapay = new \Kkiapay\Kkiapay($public_key, $private_key, $secret, $sandbox=false);
    $kkiapay->refundTransaction($transaction_id);
```

## Request to schedule payout 

#### EXAMPLE

```php
    $kkiapay = new \Kkiapay\Kkiapay($public_key, $private_key, $secret, $sandbox=false);
    $kkiapay->refundTransaction($algorithm, $send_notification, 
        $destination_type, $roof_amount, $destination,$rate_frequency);
```

| PARAMETERS      | DESCRIPTION             |
| ----------- | ----------------------- |
|  $algorithm    | (String)   "roof" or ""                 |
| $send_nofitication      | (Boolean)                    |
| $destination_type    | (String) "BANK_ACCOUNT" or "MOBILE_MONEY"              |
| $roof_amount | (String)                     |
| $destination |  (String)  |
| $rate_frequency | (String) "1m", "1w", "3j"  |


## COMPLETE  POSSIBLE STATUS LIST

| STATUS      | DESCRIPTION             |
| ----------- | ----------------------- |
|  SUCCESS    |        Successful transaction                 |
| FAILED      |         Transaction failed                |
| INSUFFICIENT_FUND    | Not enough money in developper  account              |
| TRANSACTION_NOT_ELIGIBLE | This transaction  are already reverted or are not eligible                    |
| TRANSACTION_NOT_FOUND |  Transaction not found |
| INVALID_TRANSACTION | You are not owner of this transaction  |
| INVALID_TRANSACTION_TYPE | We can't revert this transaction  |
