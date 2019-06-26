[WIP]

## Raw Files

```bash
    git clone https://github.com/kkiapay/php-sdk.git
```

## Using Composer
Run the following command to install this package using composer dep management system :

```bash
    composer require kkiapay/kkiapay-php
```


## Usage

#### Verify transaction status using thier Id
```php
    $kkiapay = new \Kkiapay\Kkiapay($public_key, $private_key, $secret, $sandbox=false);

    $kkiapay->verifyTransaction($transaction_id);
```