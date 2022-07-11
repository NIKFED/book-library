<?php

namespace App\Http\Controllers\Rest;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends BaseRestController
{
    protected Request $request;
    /**
     * @var Book
     */
    protected Model $model;


    public function __construct(
        Request $request,
        Book $model
    )
    {
        $this->request = $request;
        $this->model = $model;
    }

    protected function performIndex($user): JsonResponse
    {
        $books = $this->model->query()->get();
        return $this->respond(BookResource::collection($books));
    }

    protected function performStore($resource): JsonResponse
    {
        $resource->save();
        return $this->respond(new BookResource($resource));
    }

    protected function performShow($resource): JsonResponse
    {
        return $this->respond(new BookResource($resource));
    }

    protected function performUpdate($resource): JsonResponse
    {
        $resource->save();
        return $this->respond(new BookResource($resource));
    }

    protected function performDestroy($resource): JsonResponse
    {
        // Not implemented
    }
}
