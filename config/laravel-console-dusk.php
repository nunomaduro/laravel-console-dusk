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
    | When false it will run the Chrome window in Headless mode. Within
    | Production it will be forced to false.
    */
    'headless' => true
];
