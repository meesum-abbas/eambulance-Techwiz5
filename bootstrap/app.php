<?php

use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\DriverAuthentication;
use App\Http\Middleware\UserAuthentication;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => AdminAuthentication::class,
            'isDriver' => DriverAuthentication::class,
            'isUser' => UserAuthentication::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
