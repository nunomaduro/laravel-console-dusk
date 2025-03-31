<p align="center">
    <img src="docs/example.gif" width="100%">
</p>

<p align="center">
  <a href="https://github.com/nunomaduro/laravel-console-dusk/actions/workflows/static.yml"><img src="https://img.shields.io/github/actions/workflow/status/nunomaduro/laravel-console-dusk/static.yml?branch=master&style=flat-square&label=static analysis" alt="Static Analysis"></img></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-dusk"><img src="https://img.shields.io/packagist/v/nunomaduro/laravel-console-dusk?style=flat-square" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/nunomaduro/laravel-console-dusk"><img src="https://img.shields.io/packagist/l/nunomaduro/laravel-console-dusk?style=flat-square" alt="License"></a>
</p>

## About Laravel Console Dusk

Laravel Console Dusk was created by, and is maintained by [Nuno Maduro](https://github.com/nunomaduro), and allows the usage of [Laravel Dusk](https://github.com/laravel/dusk) in Laravel/Laravel Zero artisan commands, as well as in queued jobs.

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
```

You can publish the config file using the following artisan command:
```bash
php artisan vendor:publish --provider="NunoMaduro\LaravelConsoleDusk\LaravelConsoleDuskServiceProvider" --tag="config"
```


## Usage

Check how use [Laravel Dusk here](https://github.com/laravel/dusk).

### Usage in an Artisan command

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

### Usage in a job

Ensure that the `laravel-console-dusk.always_register` configuration setting is set to `true` (either
in your config file, or through the `LCD_ALWAYS_REGISTER` environment variable).  Then,
in your job (or wherever else you wish to use Laravel-Console-Dusk), you can resolve the 
manager and execute as follows:

```php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use NunoMaduro\LaravelConsoleDusk\ConsoleBrowser;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;

class MyDemoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle(): void
    {
        app(ManagerContract::class)->browseWithoutCommand(function (ConsoleBrowser $browser) {
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
