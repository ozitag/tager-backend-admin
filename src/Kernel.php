<?php

namespace OZiTAG\Tager\Backend\Admin;

use OZiTAG\Tager\Backend\Core\Http\Kernel as HttpKernel;
use OZiTAG\Tager\Backend\HttpCache\Middleware\CacheHttp;
use OZiTAG\Tager\Backend\HttpCache\Middleware\DoNotCacheHttp;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'api.cache' => CacheHttp::class,
        'api.disable-cache' => DoNotCacheHttp::class,
        'passport' => \App\Http\Middleware\Passport::class,
    ];
}
