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
        'log' => storage_path('laravel-console-dusk/log'),
        'source' => storage_path('laravel-console-dusk/source'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Dusk Chrome Driver Path
    |--------------------------------------------------------------------------
    |
    | You may override chrome driver path, for instance if you are using
    | laravel dusk while building a standalone application. If you don't set
    | (or set to null) this config, the default path will be used.
    |
    | In your .env file, you can set this value to "auto" to install the chrome
    | driver alongside your phar file (if any), or else to the default path.
    */
    'chrome_driver_path' => env('CONSOLE_DUSK_DRIVER_PATH'),

    /*
    | --------------------------------------------------------------------------
    | Headless Mode
    | --------------------------------------------------------------------------
    |
    | When false it will show a Chrome window while running. Within production
    | it will be forced to run in headless mode.
    */
    'headless' => true,

    /*
    | --------------------------------------------------------------------------
    | Driver Configuration
    | --------------------------------------------------------------------------
    |
    | Here you may pass options to the browser driver being automated.
    |
    | A list of available Chromium command line switches is available at
    | https://peter.sh/experiments/chromium-command-line-switches/
    */
    'driver' => [
        'chrome' => [
            'options' => [
                '--disable-gpu',
            ],
        ],
    ],
];
