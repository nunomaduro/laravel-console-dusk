<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel Console Dusk Paths
    |--------------------------------------------------------------------------
    |
    | Here you may configure the name of screenshots and logs directory as you wish.
    */
    'paths' => [
        'screenshots' => storage_path('laravel-console-dusk/screenshots'),
        'log'         => storage_path('laravel-console-dusk/log'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Console Dusk Secret
    |--------------------------------------------------------------------------
    |
    | Here you may configure the output of command.
    | It is a boolean cofiguration: true for mute the output, false otherwise
    */
    'secret' => false,
];
