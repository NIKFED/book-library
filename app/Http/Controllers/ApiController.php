<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    protected int $statusCode = 200;

    protected function getStatusCode(): int
    {
        return $this->statusCode;
    }

    protected function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respond($data, $headers = []): JsonResponse
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    protected function respondWithError($message, $title = 'Ошибка!'): JsonResponse
    {
        return $this->respond([
            'error' => [
                'title' => $title,
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    protected function respondNotFoundError($message = 'Объект не найден'): JsonResponse
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    protected function respondInternalError($message = 'Произошла внутренняя ошибка'): JsonResponse
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    protected function respondValidationError($message = 'Не все обязательные поля заполнены'): JsonResponse
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    protected function respondAuthorisationError($message = 'Нет прав'): JsonResponse
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    protected function handleHttpException(Exception $e): JsonResponse
    {
        return $this->setStatusCode($e->getCode())->respondWithError($e->getMessage());
    }
}