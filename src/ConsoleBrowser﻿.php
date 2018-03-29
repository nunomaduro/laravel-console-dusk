<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserContract;

class ConsoleBrowser﻿ implements ConsoleBrowserContract
{
    protected $command;

    protected $browser;

    public function __construct(Command $command, Browser $browser)
    {
        $this->command = $command;
        $this->browser = $browser;
    }

    public function __call(string $name, array $arguments)
    {
        $description = $this->getHumanReadableMethodDescription($name, $arguments);

        $this->command->task(
            $description,
            function () use ($name, $arguments) {
                try {
                    call_user_func_array([$this->browser, $name], $arguments);
                } catch (\Throwable $e) {
                    return false;
                }
            }
        );

        return $this;
    }

    protected function getHumanReadableMethodDescription(string $methodName, array $arguments): string
    {
        $description = Str::ucfirst(Str::lower(Str::snake($methodName, ' ')));

        foreach ($arguments as $argument) {
            if (\is_string($argument)) {
                $description .= " {{$argument}}";
            }
        }

        return $description;
    }
}
