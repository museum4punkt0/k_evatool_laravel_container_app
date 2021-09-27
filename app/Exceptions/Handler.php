<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        $this->renderable(function (AuthenticationException $e, Request $request) {
            return $this->unauthenticated($request, $e);
        });

        $this->renderable(function (AuthenticationException $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        });

        $this->renderable(function (RouteNotFoundException $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(["message" => "The specified URL cannot be found"], 404);
            }
            return response()->json(["message" => $e->getMessage()], $e->getStatusCode());
        });

        $this->renderable(function (ValidationException $e) {
            return response()->json($e->validator->errors()->getMessages(), 422);
        });

        $this->renderable(function (ModelNotFoundException $e) {
            $modelName = strtolower(class_basename($e->getModel()));
            return response()->json("No model of type " . $modelName . " found with the specified identifier", 404);
        });

        $this->renderable(function (HttpException $e) {
            return response()->json($e->getMessage(), $e->getStatusCode());
        });
    }
}
