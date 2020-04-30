<?php

namespace App\Providers;

use Soyhuce\ServiceProviderRegistrar\ServiceProvider;

class RegistrationServiceProvider extends ServiceProvider
{
    /** @var array<string> */
    public array $local = [
        \Barryvdh\Debugbar\ServiceProvider::class,
        \NunoMaduro\PhpInsights\Application\Adapters\Laravel\InsightsServiceProvider::class,
        \Soyhuce\CsFixer\ServiceProvider::class,
        \Soyhuce\DevTools\ServiceProvider::class,
        \Soyhuce\IdeHelper\IdeHelperServiceProvider::class,
    ];

    /** @var array<string> */
    public array $testing = [
    ];
}
