<?php

return [

    'environments' => [
        'local', 'production',
    ],

    'ignore' => [
        Illuminate\Auth\AuthenticationException::class,
        Illuminate\Session\TokenMismatchException::class,
        Illuminate\Validation\ValidationException::class,
        Illuminate\Auth\Access\AuthorizationException::class,
        Illuminate\Database\Eloquent\ModelNotFoundException::class,
        Symfony\Component\HttpKernel\Exception\HttpException::class,
    ],

    'driver' => 'mail',

    'drivers' => [
        'mail' => [
            'view' => 'bugnotifier::mail',
            'to' => ['address' => 'hello@example.com', 'name' => null],
        ],
    ],

];
