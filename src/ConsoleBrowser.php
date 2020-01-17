<?php

declare(strict_types=1);

namespace NunoMaduro\LaravelConsoleDusk;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use NunoMaduro\LaravelConsoleDusk\Contracts\ConsoleBrowserContract;

class ConsoleBrowser implements ConsoleBrowserContract
{
    protected $command;

    protected $browser;

    protected $inSecret = false;

    public function __construct(Command $command, Browser $browser)
    {
        $this->command = $command;
        $this->browser = $browser;
    }

    public function getOriginalBrowser(): Browser
    {
        return $this->browser;
    }

    public function inSecret(): ConsoleBrowserContract
    {
        $this->inSecret = true;

        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        $description = $this->getHumanReadableMethodDescription($name, $arguments);

        $exception = null;
        $result = null;

        $this->command->task($description, function () use ($name, $arguments, &$exception, &$result) {
            try {
                $result = call_user_func_array([$this->browser, $name], $arguments);
            } catch (\Throwable $e) {
                $exception = $e;

                return false;
            }
        });

        if ($exception !== null) {
            throw $exception;
        }

        return $result instanceof Browser ? $this : $result;
    }

    protected function getHumanReadableMethodDescription(string $methodName, array $arguments): string
    {
        $description = Str::ucfirst(Str::lower(Str::snake($methodName, ' ')));

        if (! $this->inSecret) {
            foreach ($arguments as $argument) {
                if (\is_string($argument) || (\is_object($argument) && \is_callable([$argument, '__toString']))) {
                    $description .= " <info>$argument</info>";
                }
            }
        } else {
            $description .= ' <info>...</info>';
            $this->inSecret = false;
        }

        return $description;
    }
}
