<p align="center">
    <img src="docs/example.gif" width="100%">
</p>

<p align="center">
  <a href="https://github.com/nunomaduro/laravel-console-dusk/actions/workflows/static.yml"><img src="https://img.shields.io/github/actions/workflow/status/nunomaduro/laravel-console-dusk/static.yml?branch=master&style=flat-square&label=static analysis" alt="Static Analysis"></img></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-dusk"><img src="https://img.shields.io/packagist/v/nunomaduro/laravel-console-dusk?style=flat-square" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-dusk"><img src="https://img.shields.io/packagist/l/nunomaduro/laravel-console-dusk?style=flat-square" alt="License"></a>
</p>

## About Laravel Console Dusk

Laravel Console Dusk was created by, and is maintained by [Nuno Maduro](https://github.com/nunomaduro), and allows the usage of [Laravel Dusk](https://github.com/laravel/dusk) in Laravel/Laravel Zero artisan commands.

## Installation

> **Requires [PHP 8.2+](https://php.net/releases)**

Require Laravel Console Dusk using [Composer](https://getcomposer.org):

```bash
composer require nunomaduro/laravel-console-dusk
```

The package provide a config file that allows you to configure some options.
```php
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
```

You can publish the config file using the following artisan command:
```bash
php artisan vendor:publish --provider="NunoMaduro\LaravelConsoleDusk\LaravelConsoleDuskServiceProvider" --tag="config"
```


## Usage

```php
class VisitLaravelZeroCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->browse(function ($browser) {
            $browser->visit('http://laravel-zero.com')
                ->assertSee('100% Open Source');
        });
    }
}
```

Check how use [Laravel Dusk here](https://github.com/laravel/dusk).

## Contributing

Thank you for considering to contribute to Laravel Console Dusk. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

You can have a look at the [CHANGELOG](CHANGELOG.md) for constant updates & detailed information about the changes. You can also follow the twitter account for latest announcements or just come say hi!: [@enunomaduro](https://twitter.com/enunomaduro)

## Support the development
**Do you like this project? Support it by donating**

- PayPal: [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=66BYDWAT92N6L)
- Patreon: [Donate](https://www.patreon.com/nunomaduro)

## License

Laravel Console Dusk is an open-sourced software licensed under the [MIT license](LICENSE.md).
