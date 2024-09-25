<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('api/*')) {
                if (! Auth::attempt($request->only('username', 'password'))) {
                    return response()->json([
                        'message' => 'Unauthorized'
                    ], 401);
                }
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                if (! Auth::attempt($request->only('username', 'password'))) {
                    return response()->json([
                        'message' => 'Unauthorized'
                    ], 401);
                }
            }
        });
    })->create();
