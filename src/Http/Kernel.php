<?php

namespace OZiTAG\Tager\Backend\Admin\Http;

use OZiTAG\Tager\Backend\Core\Http\Kernel as HttpKernel;

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
        'api.cache' => OZiTAG\Tager\Backend\HttpCache\Middleware\CacheHttp::class,
        'api.disable-cache' => OZiTAG\Tager\Backend\HttpCache\Middleware\DoNotCacheHttp::class,
        'passport' => OZiTAG\Tager\Backend\Admin\Middlewares\Passport::class,
    ];
}
