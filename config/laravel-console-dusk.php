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
    | --------------------------------------------------------------------------
    | Always Available Mode
    | --------------------------------------------------------------------------
    |
    | Make Laravel Console Dusk available even when not running in the context
    | of an Artisan command (e.g. from a queue worker).
    */
    'always_boot' => env('LCD_ALWAYS_BOOT', false),

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
