<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;

class LaravelConsoleDuskServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Command::macro('browse', function ($callback) {
            resolve(ManagerContract::class)->browse($this, $callback);
        });
    }

    public function register(): void
    {
        $this->app->bind(ManagerContract::class, function ($app) {
            return new Manager();
        });
    }
}
