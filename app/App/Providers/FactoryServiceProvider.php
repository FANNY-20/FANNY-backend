<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class FactoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static function (string $modelFqcn): string {
            // Transforms Domain\TheDomain\Models\TheModel to Database\Factories\TheDomain\TheModelFactory
            return str_replace(['Domain', 'Models\\'], ['Database\Factories', ''], $modelFqcn) . 'Factory';
        });
    }
}
