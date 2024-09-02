<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GBA\PersonService;
use App\Services\GBA\MembershipService;

class GBAServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register PersonService as a singleton
        $this->app->singleton(PersonService::class, function ($app) {
            return new PersonService();
        });

        // Register MembershipService as a singleton
        $this->app->singleton(MembershipService::class, function ($app) {
            return new MembershipService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
