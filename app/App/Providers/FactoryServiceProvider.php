<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class FactoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static function (string $model): string {
            return preg_replace(
                '#^Domain\\\\(.*)\\\\Models\\\\(.*)$#',
                '\\Database\\Factories\\\$1\\\$2Factory',
                $model
            );
        });
    }
}
