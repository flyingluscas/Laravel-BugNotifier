<?php

return [

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
        Illuminate\Http\Exception\HttpResponseException::class,
        Illuminate\Database\Eloquent\ModelNotFoundException::class,
        Symfony\Component\HttpKernel\Exception\HttpException::class,
        Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Here you may configure the mail driver, choose the view and the e-mail
    | address that will be notified when an exception is thrown.
    */

    'mail' => [
        'view' => 'bugnotifier::mail',
        'to' => [
            'hello@example.com', 'another@example.com',
        ],
        'driver' => FlyingLuscas\BugNotifier\Drivers\MailDriver::class,
    ],

];
