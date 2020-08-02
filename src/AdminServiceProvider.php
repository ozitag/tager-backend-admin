<?php

namespace OZiTAG\Tager\Backend\Admin;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;
use Laravel\Passport\Passport;
use OZiTAG\Tager\Backend\Admin\Listeners\AdminAuthListener;
use OZiTAG\Tager\Backend\Admin\Observers\TokenObserver;
use OZiTAG\Tager\Backend\Auth\TagerBackendAuthServiceProvider;

class AdminServiceProvider extends EventServiceProvider
{
    protected $listen = [
        AccessTokenCreated::class => [
            AdminAuthListener::class
        ],
    ];

    public function register()
    {
        $this->app->register(TagerBackendAuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        if (is_file(base_path('routes/admin.php'))) {
            Route::prefix('admin')
                ->middleware(['provider:administrators', 'auth:api'])
                ->group(base_path('routes/admin.php'));
        }

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
