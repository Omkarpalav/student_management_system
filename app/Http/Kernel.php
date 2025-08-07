<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ✅ THIS MUST BE INSIDE THE CLASS
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\AdminAuth::class,
    ];
}
