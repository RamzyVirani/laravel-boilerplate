<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use InfyOm\Generator\Utils\ResponseUtil;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Class Handler
 * @package App\Exceptions
 */
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     * @return void
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            //return response()->json(['token_expired'], $exception->getStatusCode());
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please check the URL you submitted', 'data' => [], 'errors' => [['label' => 'URL Exception Error', 'message' => 'Please check the URL you submitted']]], 404);
            }
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            //return response()->json(['token_expired'], $exception->getStatusCode());
//            return redirect(route('admin.notifications.index'));
//            Flash::success('Kindly be Insaan Ka Baacha.');
            return redirect(route('admin.dashboard'));
        }
        if ($request->expectsJson()) {
            if ($exception instanceof TokenExpiredException) {
                return response()->json(['token_expired'], $exception->getStatusCode());
            } else if ($exception instanceof TokenInvalidException) {
                return response()->json(['token_invalid'], $exception->getStatusCode());
            }
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $prefix = $request->route()->action['prefix'];
        $prefix = (empty($prefix)) ? "" : $prefix . ".";

        return $request->expectsJson()
            ? response()->json(ResponseUtil::makeError('Unauthenticated', []), 401)
            : redirect()->guest(route($prefix . 'login'));
    }
}
