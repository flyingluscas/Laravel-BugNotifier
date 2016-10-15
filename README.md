# BugNotifier

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]
[![SensioLabs Insight][ico-sensiolabs]][link-sensiolabs]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a **Laravel 5.x** package to help you track down bugs on your applications by using notifications.

BugNotifier will catch the exceptions thrown by Laravel and notify you through e-mail.

## Install

Via Composer

``` bash
$ composer require flyingluscas/bug-notifier
```

## Usage

## 1. Service Provider
Add the `BugNotifierServiceProvider` under the `providers` section on `config/app.php` file.

``` php
'providers' => [
    // ...
    FlyingLuscas\BugNotifier\BugNotifierServiceProvider::class,
],
```

## 2. Configuration
Run this command in your terminal to publish the configuration file.

``` bash
$ php artisan vendor:publish --provider="FlyingLuscas\BugNotifier\BugNotifierServiceProvider"
```

This command will generate the `config/bugnotifier.php` config file.

Inside the configuration file, you can add the **environments** that BugNotifier should watch for exceptions,
configure a list of **exceptions that should be ignored** and choose the **driver used to send the notifications**.

## 3. Setting up
Ok, now that our service provider is in place and our configuration file is set,
let's set up the BugNotifier to watch for exceptions in our application.

Go to your `app/Exceptions/Handler.php` file, and scroll down to the `report` method, this method is very important,
here you can intercept any exceptions thrown by Laravel, so use the `Notify` **facade** to set it up.

``` php
use FlyingLuscas\BugNotifier\Facades\Notify;

// ...

public function report(Exception $exception)
{
    parent::report($exception);

    Notify::exception($exception);
}
```

And that's it, you are ready to track down every exception thrown by your application and be notified about it.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email lucas.pires.mattos@gmail.com instead of using the issue tracker.

## Credits

- [Lucas Pires][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/flyingluscas/bug-notifier.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/flyingluscas/Laravel-BugNotifier/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/68256859/shield?branch=master
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/flyingluscas/Laravel-BugNotifier.svg?style=flat-square
[ico-sensiolabs]: https://img.shields.io/sensiolabs/i/6206548d-8d81-438b-9b64-74c2bb1e412c.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/flyingluscas/Laravel-BugNotifier.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/flyingluscas/bug-notifier.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/flyingluscas/bug-notifier
[link-travis]: https://travis-ci.org/flyingluscas/Laravel-BugNotifier
[link-styleci]: https://styleci.io/repos/68256859
[link-scrutinizer]: https://scrutinizer-ci.com/g/flyingluscas/Laravel-BugNotifier/code-structure
[link-sensiolabs]: https://insight.sensiolabs.com/projects/6206548d-8d81-438b-9b64-74c2bb1e412c
[link-code-quality]: https://scrutinizer-ci.com/g/flyingluscas/Laravel-BugNotifier
[link-downloads]: https://packagist.org/packages/flyingluscas/bug-notifier
[link-author]: https://github.com/flyingluscas
[link-contributors]: ../../contributors
