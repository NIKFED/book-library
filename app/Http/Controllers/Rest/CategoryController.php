<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\ApiController;
use App\Http\Resources\BookCollection;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends ApiController
{
    protected Request $request;


    public function __construct(
        Request $request,
    )
    {
        $this->request = $request;
    }

    public function getBooksWithCategoryId($categoryId): JsonResponse
    {
        $user = $this->request->user();

        // Validation
        $query = json_decode($this->request->get('query'));

        $books = Book::query()
            ->whereHas('bookCategories', function (Builder $query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });

        if ($query->name) {
            $books->where('title', 'like', '%' . $query->name . '%');
        }

        if ($query->status) {
            $statusId = $query->status;
            $books->whereHas('status', function (Builder $query) use ($statusId) {
                $query->where('id', $statusId);
            });
        }

        if ($query->author_name) {
            $authorName = $query->author_name;
            $books->whereHas('authors', function (Builder $query) use ($authorName) {
                $query->where('name', 'like', '%' . $authorName . '%');
            });
        }

        return $this->respond(new BookCollection($books->paginate(12)));
    }
}
