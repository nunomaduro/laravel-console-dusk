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
    | --------------------------------------------------------------------------
    | Headless Mode
    | --------------------------------------------------------------------------
    |
    | When false it will show a Chrome window while running. Within production
    | it will be forced to run in headless mode.
    */
    'headless' => true,

];
