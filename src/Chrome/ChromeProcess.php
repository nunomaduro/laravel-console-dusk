<?php

namespace NunoMaduro\LaravelConsoleDusk\Chrome;

use Laravel\Dusk\Chrome\ChromeProcess as BaseChromeProcess;
use Phar;

/**
 * Extends Dusk's ChromeProcess to handle Chrome Driver Path override.
 */
class ChromeProcess extends BaseChromeProcess
{
    /** @inheritdoc */
    public function toProcess(array $arguments = [])
    {
        $chromeDriverPath = config('laravel-console-dusk.chrome_driver_path');

        if (!$this->driver && isset($chromeDriverPath)) {
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
                $filenames = [
                    'linux' => 'chromedriver-linux',
                    'mac' => 'chromedriver-mac',
                    'mac-intel' => 'chromedriver-mac-intel',
                    'mac-arm' => 'chromedriver-mac-arm',
                    'win' => 'chromedriver-win.exe',
                ];

                $this->driver = $chromeDriverPath.DIRECTORY_SEPARATOR.$filenames[$this->operatingSystemId()];
            }
        }

        return parent::toProcess($arguments);
    }
}
