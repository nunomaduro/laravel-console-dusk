<?php

namespace NunoMaduro\LaravelConsoleDusk\Chrome;

use \Laravel\Dusk\Chrome\SupportsChrome as BaseSupportsChrome;

/**
 * Overrides Laravel\Dusk\Chrome\SupportsChrome::buildChromeProcess
 */
trait SupportsChrome
{
    use BaseSupportsChrome;

    /**
     * Build the process to run the Chromedriver.
     *
     * @param  array  $arguments
     * @return \Symfony\Component\Process\Process
     *
     * @throws \RuntimeException
     *
     * @overrides Laravel\Dusk\Chrome\SupportsChrome::buildChromeProcess
     *            Makes it use NunoMaduro\LaravelConsoleDusk\Chrome\ChromeProcess
     *            instead of Laravel\Dusk\Chrome\ChromeProcess
     */
    protected static function buildChromeProcess(array $arguments = [])
    {
        return (new ChromeProcess(static::$chromeDriver))->toProcess($arguments);
    }
}
