<?php

namespace App\Commands\Clean;

use Domain\Meet\Models\Meet;
use Illuminate\Console\Command;

class CleanMeets extends Command
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $signature = 'stop-covid:clean-meets';

    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $description = 'Delete meets after existing x minutes';

    public function handle(): void
    {
        $date = now()->subMinutes(config('stop-covid.clean.meets'));

        Meet::where('updated_at', '<', $date)
            ->delete();
    }
}
