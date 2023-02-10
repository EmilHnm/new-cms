<?php

namespace App\Exceptions;

use Throwable;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() == 403)
                return response()->view('errors.403_error');
            if ($exception->getStatusCode() == 404)
                return response()->view('errors.404_error');
        }
        if ($exception instanceof UnauthorizedException) {
            return response()->view('errors.403_error');
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404_error');
        }
        if ($exception instanceof ModelNotFoundException) {
            return response()->view('errors.404_error');
        }
        // dd($exception->getStatusCode(), $request);
        return parent::render($request, $exception);
    }
}
