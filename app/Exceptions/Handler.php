<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {


        if ($exception instanceof ModelNotFoundException) {
            return response()->json(
                [
                    'message' => str_replace('App\\', '', $exception->getMessage()) . ' not found',
                    'statusCode' => "404",
                    'success' => 0
                ]
            );
        }  else {
            error_log($exception->getCode(), 0);
            return response()->json(
                [
                    'statusCode' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'success' => 0
                ]
            );
        };

        return parent::render($request, $exception);
    }
}
