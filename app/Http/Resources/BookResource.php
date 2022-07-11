<?php

namespace App\Http\Resources;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Book $this */
        return [
            'title' => $this->title,
            'isbn' => $this->isbn,
            'page_count' => $this->page_count,
            'thumbnail_url' => $this->thumbnail_url,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'published_date' => Carbon::parse($this->published_date)->format('Y-m-d H:m:s'),
            'book_status' => new DictionaryResource($this->status),
            'authors' => AuthorResource::collection($this->authors),
            'categories' => DictionaryResource::collection($this->categories),
        ];
    }
}
