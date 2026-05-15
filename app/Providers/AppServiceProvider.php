<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

/**
 * Application-level service provider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register container bindings.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap application services. Applies a few defensive defaults:
     *
     *  - forces HTTPS URL generation in production,
     *  - sets a strong default password policy globally,
     *  - prevents accidental destructive actions on production models.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Password::defaults(static function (): Password {
            $rule = Password::min(12)->letters()->mixedCase()->numbers()->symbols();

            return app()->isProduction() ? $rule->uncompromised() : $rule;
        });
    }
}
