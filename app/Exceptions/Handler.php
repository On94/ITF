<?php

namespace App\Exceptions;

use App\Http\Resources\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            $status = 'error';
            $message = $e->getMessage();
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            return ApiResponse::make([
                'status' => $status,
                'message' => $message,
                'data' => $e instanceof ValidationException ? $e->validator->errors() : null,
            ])->response()->setStatusCode($statusCode);
        }

        return parent::render($request, $e);
    }
}
