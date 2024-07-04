<?php

namespace OZiTAG\Tager\Backend\Admin;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Events\AccessTokenCreated;
use OZiTAG\Tager\Backend\Admin\Console\ResetAdminAccessTokenCommand;
use OZiTAG\Tager\Backend\Admin\Listeners\DeleteAdminRoleListener;
use OZiTAG\Tager\Backend\Admin\Observers\TokenObserver;
use OZiTAG\Tager\Backend\Auth\AuthServiceProvider;
use OZiTAG\Tager\Backend\Auth\Events\TagerAuthRequest;
use OZiTAG\Tager\Backend\Auth\Events\TagerAuthSuccessRequest;
use OZiTAG\Tager\Backend\Auth\Events\TagerSuccessAuthRequest;
use OZiTAG\Tager\Backend\Mail\Console\FlushMailTemplatesCommand;
use OZiTAG\Tager\Backend\Mail\Console\ResendSkipMailCommand;
use OZiTAG\Tager\Backend\Rbac\Events\TagerRoleDeleted;

class AdminServiceProvider extends EventServiceProvider
{
    protected $listen = [
        TagerRoleDeleted::class => [
            DeleteAdminRoleListener::class
        ],
    ];

    public function register()
    {
        parent::register();
        $this->app->register(AuthServiceProvider::class);
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

        if ($this->app->runningInConsole()) {
            $this->commands([
               ResetAdminAccessTokenCommand::class
            ]);
        }
    }
}
