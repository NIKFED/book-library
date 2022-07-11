<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\ApiController;
use App\Models\Book;
use App\Models\Dictionaries\Dictionary;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DictionaryController extends ApiController
{
    protected Request $request;
    /**
     * @var Dictionary
     */
    protected Model $model;

    public function __construct(
        Request $request
    )
    {
        $this->request = $request;
    }

    public function store(string $dictName): JsonResponse
    {
        $user = $this->request->user();
        $data = $this->request->all();

        $this->setModel($dictName);

        $resource = $this->fillData($this->model, $data);
//        if (!$user || !$user->can('create', $resource)) {
//            return $this->respondAuthorisationError();
//        }

        try {
            $this->checkValidation($resource);
            return $this->performStore($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    public function destroy(string $dictName, int $id): JsonResponse
    {
        $user = $this->request->user();

        $this->setModel($dictName);

        $resource = $this->model::query()->find($id);

        if (!$resource) {
            return $this->respondNotFoundError();
        }

//        if (!$user || !$user->can('delete', $resource)) {
//            return $this->respondAuthorisationError();
//        }

        try {
            return $this->performDestroy($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    public function update(string $dictName, int $id): JsonResponse
    {
        $user = $this->request->user();

        $this->setModel($dictName);

        $resource = $this->model::query()->find($id);

        if (!$resource) {
            return $this->respondNotFoundError();
        }

//        if (!$user || !$user->can('update', $resource)) {
//            return $this->respondAuthorisationError();
//        }

        $data = $this->request->all();

        try {
            $resource = $this->fillData($resource, $data);
            $this->checkValidation($resource);
            return $this->performUpdate($resource);
        } catch (Exception $e) {
            return $this->handleHttpException($e);
        }
    }

    protected function performStore(Model $resource): JsonResponse
    {
        $resource->save();
        return $this->respond($resource);
    }

    protected function performDestroy(Model $resource): JsonResponse
    {
        $resource->delete();
        return $this->respond($resource);
    }

    protected function performUpdate(Model $resource): JsonResponse
    {
        $resource->save();
        return $this->respond($resource);
    }

    protected function fillData(Model $resource, array $data): Model
    {
        $resource->fill($data);
        return $resource;
    }

    /**
     * @throws Exception
     */
    protected function checkValidation(Model $resource)
    {
        if (method_exists($resource, 'getValidationErrors')) {
            $errors = $resource->getValidationErrors();
            if (count($errors) > 0) {
                throw new Exception($errors->all()[0], 400);
            }
        }
    }

    protected function setModel(string $dictName): void
    {
        $parseDictName = ucfirst(Str::singular(Str::camel($dictName)));
        $this->model = app("App\Models\Dictionaries\\" . $parseDictName);
    }
}
