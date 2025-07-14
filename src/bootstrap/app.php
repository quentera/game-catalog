<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\apiResponseMiddleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(apiResponseMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $exception){
            Log::info("Inavlidtoken class invoked");
                if ($exception instanceof JWTException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Token is not provided or malformed',
                    ], Response::HTTP_UNAUTHORIZED);
                }
                if ($exception instanceof TokenExpiredException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Token has expired',
                    ], Response::HTTP_UNAUTHORIZED);
                }

                if ($exception instanceof TokenInvalidException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Token is invalid',
                    ], Response::HTTP_UNAUTHORIZED);
                }

                if ($exception instanceof TokenBlacklistedException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Token has been blacklisted',
                    ], Response::HTTP_UNAUTHORIZED);
                }
                if ($exception instanceof ErrorException) {
                    return response()->json([
                                'status' => false,
                                'message' => $exception->getMessage(),
                            ], Response::HTTP_UNAUTHORIZED);
                }
        });
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
        if ($request->is('api/*')) {
            return true;
        }
 
        return $request->expectsJson();
    });
    })->create();
