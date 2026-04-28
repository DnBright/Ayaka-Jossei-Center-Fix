<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('login.admin');
            }
            if ($request->is('penulis') || $request->is('penulis/*')) {
                return route('login.penulis');
            }
            return route('login.admin'); // Default
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
