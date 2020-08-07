<?php

namespace App\Commands\Clean;

use Domain\Token\Models\Token;
use Illuminate\Console\Command;

class CleanTokens extends Command
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $signature = 'stop-covid:clean-tokens';

    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $description = 'Delete tokens after existing x days';

    public function handle(): void
    {
        $date = now()->subDays(config('stop-covid.clean.tokens'));

        Token::whereDate('updated_at', '<', $date)
            ->delete();
    }
}
