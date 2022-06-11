<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpFoundation\Response;


class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->renderable(function (TokenExpiredException $e, $request) {
            if ($e instanceof TokenExpiredException && $request->wantsJson()) {
                return response()->json([
                    'code' => Response::HTTP_NOT_ACCEPTABLE,
                    'status' => false,
                    'message' => 'Token expired.'
                ], Response::HTTP_NOT_ACCEPTABLE);
            }
        });

        $this->renderable(function (TokenInvalidException $e, $request) {
            if ($e instanceof TokenInvalidException && $request->wantsJson()) {
                return response()->json([
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'status' => false,
                    'message' => 'The token is invalid.'
                ], Response::HTTP_UNAUTHORIZED);
            }
        });

        $this->renderable(function (JWTException $e, $request) {
            if ($e instanceof JWTException && $request->wantsJson()) {
                return response()->json([
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => false,
                    'message' => 'The token is required.'
                ], Response::HTTP_NOT_FOUND);
            }
        });
    }
}