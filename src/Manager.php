<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Closure;
use Throwable;
use Illuminate\Console\Command;
use NunoMaduro\LaravelConsoleDusk\Drivers\Chrome;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\Drivers\DriverContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserFactoryContract;

class Manager implements ManagerContract
{
    protected $driver;

    protected $browserFactory;

    public function __construct(DriverContract $driver = null, ConsoleBrowserFactoryContract $browserFactory = null)
    {
        $this->driver = $driver ?: new Chrome();
        $this->browserFactory = $browserFactory ?: new ConsoleBrowserFactory();
    }

    public function browse(Command $command, Closure $callback): void
    {
        $this->driver->open();

        $browser = $this->browserFactory->make($command, $this->driver);

        try {
            $callback($browser);
        } catch (\Throwable $e) {
        }

        $browser->getOriginalBrowser()
            ->quit();

        $this->driver->close();

        if (! empty($e)) {
            throw $e;
        }
    }
}
