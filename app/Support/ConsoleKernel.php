<?php

namespace Support;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ConsoleKernel extends Kernel
{
    /**
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    protected function commands(): void
    {
        $directories = File::directories(app_path('Commands'));

        if (!app()->environment('local')) {
            $directories = array_filter($directories, static function (string $directory) {
                return !Str::endsWith($directory, '/Dev');
            });
        }

        $this->load($directories);
    }
}