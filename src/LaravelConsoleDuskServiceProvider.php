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
            $manager = resolve(ManagerContract::class);

            Browser::$baseUrl = config('app.url');
            Browser::$storeScreenshotsAt = $this->getPath('screenshots');
            Browser::$storeConsoleLogAt = $this->getPath('log');

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

    protected function getPath(string $path): string
    {
        return tap(storage_path('laravel-console-dusk' . DIRECTORY_SEPARATOR . $path), function ($path) {
            foreach ([storage_path(), storage_path("laravel-console-dusk"), $path] as $folder) {
                if (! File::exists($folder)) {
                    File::makeDirectory($folder);
                }
            }
        });
    }
}
