<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Closure;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserFactoryContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\Drivers\DriverContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\ManagerContract;
use NunoMaduro\LaravelConsoleDusk\Drivers\Chrome;
use ReflectionFunction;

class Manager implements ManagerContract
{
    protected $driver;

    protected $browserFactory;

    public function __construct(?DriverContract $driver = null, ?ConsoleBrowserFactoryContract $browserFactory = null)
    {
        $this->driver = $driver ?: new Chrome;
        $this->browserFactory = $browserFactory ?: new ConsoleBrowserFactory;
    }

    public function browse(Command $command, Closure $callback): void
    {
        $this->driver->open();

        $browsers = $this->createBrowsers($command, $callback);

        try {
            $callback(...$browsers->all());
        } catch (\Throwable $e) {
        }

        $browsers->each->quit();

        $this->driver->close();

        if (! empty($e)) {
            throw $e;
        }
    }

    /** @return Collection<int, ConsoleBrowserContract> */
    protected function createBrowsers(Command $command, Closure $callback): Collection
    {
        $browsers = collect();

        $browsersNeededFor = (new ReflectionFunction($callback))->getNumberOfParameters();

        for ($i = 0; $i < $browsersNeededFor; $i++) {
            $browsers->push($this->browserFactory->make($command, $this->driver));
        }

        return $browsers;
    }
}
