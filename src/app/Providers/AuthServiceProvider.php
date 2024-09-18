<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\CalendarPolicy;
use App\Policies\RelatorioPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('alterarArea', [CalendarPolicy::class, 'alterarArea']);
        Gate::define('verCalendario', [CalendarPolicy::class, 'verCalendario']);
        Gate::define('verRelatorio', [RelatorioPolicy::class, 'verRelatorio']);
    }
}
