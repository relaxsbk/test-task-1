<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        /**
         * Переопределение существующего Exceptions
         */

//        $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
//            return response()->json([
//                'message' => 'Route not found'
//            ], 404);
//        });
        /**
         * определение кастомного Exceptions
         */
        $exceptions->render(function (\App\Exceptions\Event\EventNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        });

        //


    })->create();
