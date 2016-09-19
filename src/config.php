<?php

return [

    'driver' => 'mail',

    'drivers' => [
        'mail' => [
            'view' => 'bugnotifier::mail',
            'to' => ['address' => 'hello@example.com', 'name' => null],
        ],
    ],

];
