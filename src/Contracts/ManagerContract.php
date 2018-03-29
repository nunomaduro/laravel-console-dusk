<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk\Contracts;

use Closure;
use Laravel\Dusk\Browser;
use Illuminate\Console\Command;

interface ManagerContract
{
    public function browse(Command $command, Closure $callback): void;
}
