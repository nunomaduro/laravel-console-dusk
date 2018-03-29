<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\Drivers\DriverContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserFactoryContract;

class ConsoleBrowser﻿Factory implements ConsoleBrowserFactoryContract
{
    use ProvidesBrowser;

    protected $driver;

    public function make(Command $command, DriverContract $driver): ConsoleBrowserContract
    {
        $this->driver = $driver;

        return new ConsoleBrowser﻿($command, new Browser($this->createWebDriver()));
    }

    protected function driver()
    {
        return $this->driver->getDriver();
    }
}
