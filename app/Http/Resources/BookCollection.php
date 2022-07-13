<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class BookCollection extends ResourceCollection
{
    #[ArrayShape([
        'data' => "\Illuminate\Support\Collection",
        'meta' => "array"
    ])]
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'total_entries' => $this->resource->total(),
                'last_page' => $this->resource->lastPage(),
            ],
        ];
    }
}