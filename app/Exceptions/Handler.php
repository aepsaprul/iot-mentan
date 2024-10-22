<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    public function render($request, Throwable $exception)
    {
      // Cek apakah status code 419 (Page Expired)
      if ($exception instanceof HttpException && $exception->getStatusCode() == 419) {
        // Redirect ke halaman login dengan pesan
        return redirect()->route('login')->with('message', 'Session expired, please log in again.');
      }

      // Kembalikan ke parent untuk exception lain
      return parent::render($request, $exception);
    }
}
