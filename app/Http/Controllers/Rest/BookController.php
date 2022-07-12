<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\ApiController;
use App\Http\Resources\BookResource;
use App\Models\AuthorBook;
use App\Models\Book;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends ApiController
{
    protected Request $request;
    /**
     * @var Book
     */
    protected Book $model;


    public function __construct(
        Request $request,
        Book $model
    )
    {
        $this->request = $request;
        $this->model = $model;
    }

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
            $resource->save();

            $collection = $resource->authorBooks;
            if ($this->request->has('authors')) {
                foreach ($this->request->get('authors') as $authorBook) {
                    $authorBook = json_decode($authorBook);
                    $authorBookId = $authorBook->id;
                    $filteredCollection = $resource->authors->filter(function ($value, $key) use ($authorBookId) {
                        return $value->author_id !== $authorBookId;
                    });
                    if ($collection->count() === $filteredCollection->count()) {
                        $authorBookResource = new AuthorBook();
                        $authorBookResource->author_id = $authorBookId;
                        $authorBookResource->book_id = $resource->id;
                        $authorBookResource->save();
                    } else {
                        $collection = $filteredCollection;
                    }
                }
            }
            foreach ($collection as $item) {
                $item->delete();
            }


            return $this->respond(new BookResource($resource));
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

    protected function performDestroy($resource): JsonResponse
    {
        // Not implemented
    }

    protected function fillData($resource, $data)
    {
        $resource->fill($data);
        return $resource;
    }
}
