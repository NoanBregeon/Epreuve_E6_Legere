<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...existing middleware...
    ];

    protected $middlewareGroups = [
        'web' => [
            // ...existing middleware...
        ],

        'api' => [
            // ...existing middleware...
        ],
    ];

    protected $routeMiddleware = [
        // ...existing middleware...
    ];

    protected $middlewareAliases = [
        // ...existing aliases...
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}
