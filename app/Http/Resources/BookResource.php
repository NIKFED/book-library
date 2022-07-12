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
            'id' => $this->id,
            'title' => $this->title,
            'isbn' => $this->isbn,
            'page_count' => $this->page_count,
            'thumbnail_url' => $this->thumbnail_url,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'published_date' => Carbon::parse($this->published_date)->format('Y-m-d H:m:s'),
            'status' => new DictionaryResource($this->status),
            'authors' => DictionaryResource::collection($this->authors),
            'categories' => DictionaryResource::collection($this->categories),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
