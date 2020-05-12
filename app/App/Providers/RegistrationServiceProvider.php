<?php

namespace App\Providers;

use Soyhuce\ServiceProviderRegistrar\ServiceProvider;

class RegistrationServiceProvider extends ServiceProvider
{
    /** @var array<string> */
    public array $local = [
        \Barryvdh\Debugbar\ServiceProvider::class,
        \NunoMaduro\PhpInsights\Application\Adapters\Laravel\InsightsServiceProvider::class,
        \Soyhuce\DevTools\ServiceProvider::class,
        \Soyhuce\NextIdeHelper\NextIdeHelperServiceProvider::class,
    ];

    /** @var array<string> */
    public array $testing = [
    ];
}
