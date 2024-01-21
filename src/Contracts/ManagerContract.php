<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk\Contracts;

use Closure;
use Illuminate\Console\Command;

interface ManagerContract
{
    public function browse(Command|null $command, Closure $callback): void;
}
