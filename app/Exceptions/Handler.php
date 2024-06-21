<?php

namespace App\Exceptions;

use Throwable;
use Psr\Log\LogLevel;
use Illuminate\Http\JsonResponse;
use App\Constants\ResponseMessage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->renderable(function (TokenInvalidException $e, $request) {
            if ($request->is('api/*')) {
                return Response::json([
                    'code' => 'AUTH-TIN',
                    'message' => 'Invalid token'
                ], 401);
            }
        });
        $this->renderable(function (TokenExpiredException $e, $request) {
            if ($request->is('api/*')) {
                return Response::json([
                    'code' => 'AUTH-TEX',
                    'message' => 'Token has Expired'
                ], 401);
            }
        });

        $this->renderable(function (JWTException $e, $request) {
            if ($request->is('api/*')) {
                return Response::json([
                    'code' => 'AUTH-TNP',
                    'message' => 'Token not parsed'
                ], 401);
            }
        });

        // error not found
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return response()->json([
                        'code' => JsonResponse::HTTP_NO_CONTENT,
                        'message' => ResponseMessage::SUCCESS_NO_CONTENT,
                    ], JsonResponse::HTTP_OK);
                }
                return response()->json([
                    'status' => 404,
                    'message' => ResponseMessage::ERROR_TARGET_NOT_FOUND,
                ], 404);
            }
        });

        // set globaly error query exeption
        $this->renderable(function (QueryException $e, $request) {
            if ($request->is('api/*')) {
                Log::error($e->getMessage());
                // get env value
                $env = env('APP_ENV');

                if ($env == 'local') {
                    return response()->json([
                        'message' => $e->getMessage(),
                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                }
                return response()->json([
                    'message' => 'Something went wrong',
                ], 500);
            }
        });

        // set globaly error validation
        $this->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'message' => ResponseMessage::ERROR_VALIDATION,
                'validation_error' => $e->validator->errors(),
            ], 400);
        });
    }
}
