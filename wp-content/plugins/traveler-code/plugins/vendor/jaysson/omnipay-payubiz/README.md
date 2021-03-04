# OmniPay PayUBiz

Integrates PayUBiz payment gateway with Omnipay.

## Install

Via Composer

``` bash
$ composer require jaysson/omnipay-payubiz
```

## Usage

### Configuration
``` php
$gateway = OmniAuth::create('PayUBiz');
$gateway->setKey(MERCHANT_ID);
$gateway->setSalt(PAYU_SALT);
$params = [
    'name' => $user->name,
    'email' => $user->email,
    'amount' => $product->amount,
    'product' => $product->name,
    'transactionId' => uniqid(),
    'failureUrl' => url('api/v1/checkout/failed'),
    'returnUrl' => url('api/v1/checkout/thank-you')
];

$gateway->purchase($params)->send()->redirect();
```
Check official OmniPay documentation for more

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email prabhakarbhat@live.com instead of using the issue tracker.

## Credits
- [Prabhakar Bhat][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jaysson/omnipay-payubiz.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jaysson/omnipay-payubiz.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jaysson/omnipay-payubiz
[link-downloads]: https://packagist.org/packages/jaysson/omnipay-payubiz
[link-author]: https://github.com/jaysson
