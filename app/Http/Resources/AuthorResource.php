<?php

namespace App\Http\Resources;

use App\Models\Dictionaries\Author;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class AuthorResource extends JsonResource
{
    #[ArrayShape([
        'name' => "string"
    ])]
    public function toArray($request): array
    {
        /** @var Author $this */
        return [
            'name' => $this->full_name,
        ];
    }
}
