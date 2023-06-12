<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
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
        $this->renderable(function (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], $this->getCode((int)$e->getCode()));
        });
    }

    private function getCode(int $code): int {
        if ($code > Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        if ($code < Response::HTTP_CONTINUE) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $code;
    }
}
