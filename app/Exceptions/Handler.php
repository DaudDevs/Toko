<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    protected $levels = [
        // Custom log levels (opsional)
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Tambahkan pengecekan error route tidak ditemukan
        if ($exception instanceof RouteNotFoundException) {
            return response()->view('errors.route-not-found', [], 404);
        }

        return parent::render($request, $exception);
    }
}
