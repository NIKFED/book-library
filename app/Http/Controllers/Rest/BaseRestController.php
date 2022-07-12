<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseRestController extends ApiController
{
    protected Request $request;
    protected Model $model;

    public function index(): JsonResponse
    {
        $user = $this->request->user();

        // Validation

        try {
            return $this->performIndex($user);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    public function store(): JsonResponse
    {
        $user = $this->request->user();

        // Validation

        $data = $this->request->all();
        $resource = $this->fillData($this->model, $data);


        try {
            return $this->performStore($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    public function show($id): JsonResponse
    {
        $user = $this->request->user();

        // Validation

        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->respondNotFoundError();
        }

        try {
            return $this->performShow($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    public function update($id): JsonResponse
    {
        $user = $this->request->user();

        // Validation

        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->respondNotFoundError();
        }

        $data = $this->request->all();


        try {
            $resource = $this->fillData($resource, $data);
            return $this->performUpdate($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    public function destroy($id): JsonResponse
    {
        $user = $this->request->user();

        // Validation

        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->respondNotFoundError();
        }

        try {
            return $this->performDestroy($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    abstract protected function performIndex($user);

    abstract protected function performStore($resource);

    abstract protected function performShow($resource);

    abstract protected function performUpdate($resource);

    abstract protected function performDestroy($resource);

    protected function fillData($resource, $data)
    {
        $resource->fill($data);
        return $resource;
    }
}