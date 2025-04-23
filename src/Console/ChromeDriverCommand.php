<?php

namespace NunoMaduro\LaravelConsoleDusk\Console;

use Laravel\Dusk\Console\ChromeDriverCommand as BaseDriverCommand;
use Phar;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'dusk:chrome-driver')]
class ChromeDriverCommand extends BaseDriverCommand
{
    /** @inheritdoc */
    public function __construct()
    {
        $chromeDriverPath = config('laravel-console-dusk.chrome_driver_path');

        // Check if driver path is overriden
        if (isset($chromeDriverPath)) {
            if ($chromeDriverPath === 'auto') {
                // Set the driver directory to the phar's directory
                // Or else, don't do anything
                if (($pharPath = Phar::running(false)) !== '') {
                    $chromeDriverPath = dirname($pharPath);
                } else {
                    $chromeDriverPath = null;
                }
            }

            if ($chromeDriverPath !== null) {
                $this->directory = $chromeDriverPath.DIRECTORY_SEPARATOR;
            }
        }

        parent::__construct();
    }
}
