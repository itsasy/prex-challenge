<?php

namespace Src\Infrastructure\Traits;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Src\Domain\Auth\Exceptions\InvalidCredentialsException;
use Src\Domain\Auth\Exceptions\UserNotFoundException;
use Src\Domain\Gif\Exceptions\GifNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

trait ApiCustomExceptions
{
    use ApiResponder;

    public function handleException($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse('The specified URL cannot be found.', 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('The specified method for the request is invalid.', 405);
        }

        if ($e instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($e->getModel()));
            return $this->errorResponse("No {$modelName} exists with the specified identification.", 404);
        }

        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        if ($e instanceof QueryException) {
            $code = $e->errorInfo[1];
            if ($code == 19 || $code == 1451) {
                return $this->errorResponse('Cannot remove this resource permanently. It is related with another resource.', 409);
            }
        }

        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        }

        if ($e instanceof HttpException) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        }

        if ($e instanceof UserNotFoundException) {
            return $this->errorResponse('User not found.', 404);
        }

        if ($e instanceof InvalidCredentialsException) {
            return $this->errorResponse('Invalid credentials.', 401);
        }

        if ($e instanceof GifNotFoundException) {
            return $this->errorResponse('Gif not found.', 404);
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return $this->errorResponse('Unexpected error. Try again later.', 500);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, 422);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('Unauthenticated.', 401);
    }
}
