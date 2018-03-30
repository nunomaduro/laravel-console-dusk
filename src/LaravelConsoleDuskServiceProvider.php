<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Laravel\Dusk\Browser;
use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;

class LaravelConsoleDuskServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $manager = resolve(ManagerContract::class);

            Browser::$baseUrl = config('app.url');
            Browser::$storeScreenshotsAt = storage_path('laravel-console-dusk/screenshots');
            Browser::$storeConsoleLogAt = storage_path('laravel-console-dusk/log');

            Command::macro('browse', function ($callback) use ($manager) {
                $manager->browse($this, $callback);
            });
        }
    }

    public function register(): void
    {
        $this->app->bind(ManagerContract::class, function ($app) {
            return new Manager();
        });
    }

    public function provides(): array
    {
        return [ManagerContract::class];
    }
}
