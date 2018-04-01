<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk\Contracts;

use Laravel\Dusk\Browser;
use Illuminate\Support\Collection;

interface ConsoleBrowserContract
{
    public function getOriginalBrowser(): Browser;

    public function getDownloads(): Collection;
}
