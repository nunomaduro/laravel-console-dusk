<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk\Contracts;

use Illuminate\Console\Command;
use NunoMaduro\LaravelConsoleDusk\Contracts\Drivers\DriverContract;

interface ConsoleBrowserFactoryContract
{
    public function make(Command $command, DriverContract $driver): ConsoleBrowserContract;
}
