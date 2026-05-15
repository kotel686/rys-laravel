<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
     * Bootstrap application services. Forces HTTPS URL generation in
     * production environments.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
