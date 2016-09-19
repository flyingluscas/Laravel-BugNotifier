<?php

return [

    'driver' => 'mail',

    'drivers' => [
        'mail' => [
            'view' => 'bugnotifier::mail',
            'from' => ['address' => 'hello@example.com', 'name' => null],
        ],
    ],

];
