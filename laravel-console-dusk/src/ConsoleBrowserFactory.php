<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\Drivers\DriverContract;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserFactoryContract;

class ConsoleBrowser﻿Factory implements ConsoleBrowserFactoryContract
{
    public function make(Command $command, DriverContract $driver): ConsoleBrowserContract
    {
        return new ConsoleBrowser﻿($command, new Browser($driver));
    }
}
