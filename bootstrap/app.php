<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
        ]);

        //Append the LoadUser middle ware to the web group since the Session middleware is part of that group
        $middleware->appendToGroup(
            'web',
            [
                \App\Http\Middleware\LoadUser::class,
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
