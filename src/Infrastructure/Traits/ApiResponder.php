<?php

namespace Src\Infrastructure\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponder
{
    public function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json([
            'error' => $message, 'code' => $code
        ], $code);
    }

    public function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse([
            'data' => $collection
        ], $code);
    }

    public function showOne(Model $model, $code = 200)
    {
        return $this->successResponse([
            'data' => $model
        ], $code);
    }

    public function deleteMessage($code = 200)
    {
        return $this->successResponse([
            'message' => 'The resource was deleted successfully',
            'code' => $code
        ], $code);
    }

    public function logoutMessage($code = 200)
    {
        return $this->successResponse([
            'message' => 'The session was closed successfully.',
            'code' => $code],
            $code);
    }

    public function showMessage($message, $code = 200)
    {
        return $this->successResponse([
            'message' => $message,
        ], $code);
    }
}
