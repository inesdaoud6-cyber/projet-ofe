<<<<<<< HEAD
<?php
=======
﻿<?php
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
=======
use App\Http\Middleware\SetLocale;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
<<<<<<< HEAD
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
=======
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            SetLocale::class,  // ← c'est ça qui manque probablement
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
