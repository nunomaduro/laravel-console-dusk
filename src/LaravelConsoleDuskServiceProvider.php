<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;

class LaravelConsoleDuskServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            Command::macro('browse', function ($callback) {
                resolve(ManagerContract::class)->browse($this, $callback);
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
