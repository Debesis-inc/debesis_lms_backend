<?php

namespace App\Http\Middleware;

// use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Closure;


class Kernel
{
      // Other properties and methods...

      protected $routeMiddleware = [
        // Other middleware...

        'role' => \App\Http\Middleware\CheckRole::class,

        // More middleware...
    ];
}
