<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Environments
    |--------------------------------------------------------------------------
    |
    | Here you may configure all the environments that Bug Notifier
    | should watch for bugs, you can set multiple environments.
    */

    'environments' => [
        'local', 'production',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignore
    |--------------------------------------------------------------------------
    |
    | Here you may configure the exceptions that Bug Notifier should not report,
    | exceptions that should be ignored when thrown by your application.
    */

    'ignore' => [
        Illuminate\Auth\AuthenticationException::class,
        Illuminate\Session\TokenMismatchException::class,
        Illuminate\Validation\ValidationException::class,
        Illuminate\Auth\Access\AuthorizationException::class,
        Illuminate\Database\Eloquent\ModelNotFoundException::class,
        Symfony\Component\HttpKernel\Exception\HttpException::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Here you may configure the driver used to send the notifications when
    | an exception is thrown in your application.
    */

    'driver' => 'mail',

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Here you may configure all the supported drivers by Bug Notifier,
    | but you can use only one of them to send the notifications.
    */

    'drivers' => [
        'mail' => [
            'view' => 'bugnotifier::mail',
            'to' => ['address' => 'hello@example.com', 'name' => null],
        ],
    ],

];
