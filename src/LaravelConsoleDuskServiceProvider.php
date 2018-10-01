<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Laravel\Dusk\Browser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;

class LaravelConsoleDuskServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-console-dusk.php' => config_path('laravel-console-dusk.php'),
                ], 'config');

            $manager = resolve(ManagerContract::class);

            Browser::$baseUrl = config('app.url');
            Browser::$storeScreenshotsAt = $this->getPath(config('laravel-console-dusk.paths.screenshots'));
            Browser::$storeConsoleLogAt = $this->getPath(config('laravel-console-dusk.paths.log'));
            $inSecret = config('laravel-console-dusk.secret');

            Command::macro('browse', function ($callback) use ($manager, $inSecret) {
                $manager->browse($this, $callback, $inSecret);
            });
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-console-dusk.php', 'laravel-console-dusk');

        $this->app->bind(ManagerContract::class, function ($app) {
            return new Manager();
        });
    }

    public function provides(): array
    {
        return [ManagerContract::class];
    }

    protected function getPath(string $path): string
    {
        return tap($path, function ($path) {
            if(! File::exists($path)) {
                File::makeDirectory($path,0755, true);
            }
        });
    }
}
