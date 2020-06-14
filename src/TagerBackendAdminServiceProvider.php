<?php

namespace OZiTAG\Tager\Backend\Admin;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Events\AccessTokenCreated;
use OZiTAG\Tager\Backend\Admin\Listeners\AdminAuthListener;

class TagerBackendAdminServiceProvider extends EventServiceProvider
{
    protected $listen = [
        AccessTokenCreated::class => [
            AdminAuthListener::class
        ],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
                ->middleware(['passport:administrators', 'auth:api'])
                ->group(base_path('routes/admin.php'));
        }

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
