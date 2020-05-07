<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->make(Gate::class)->guessPolicyNamesUsing(static function (string $modelClass) {
            return Str::replaceFirst('Models', 'Policies', $modelClass) . 'Policy';
        });
    }
}
